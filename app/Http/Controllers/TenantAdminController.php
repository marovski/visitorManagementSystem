<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Security;
use Auth;
use Session;

class TenantAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'org.active', 'org.admin']);
    }

    public function index()
    {
        $org   = Auth::user()->organization;
        $plan  = $org->plan;
        $stats = [
            'users'    => User::where('organization_id', $org->id)->count(),
            'visitors' => \App\Models\Visitor::where('organization_id', $org->id)->count(),
            'meetings' => \App\Models\Meeting::where('organization_id', $org->id)->count(),
        ];

        return view('admin.index', compact('org', 'plan', 'stats'));
    }

    public function users()
    {
        $org   = Auth::user()->organization;
        $users = User::where('organization_id', $org->id)->paginate(15);
        $roles = Security::all();

        return view('admin.users.index', compact('users', 'roles', 'org'));
    }

    public function storeUser(Request $request)
    {
        $org = Auth::user()->organization;

        // Enforce plan user limit
        $maxUsers = $org->plan->max_users;
        $currentCount = User::where('organization_id', $org->id)->count();

        if ($maxUsers > 0 && $currentCount >= $maxUsers) {
            Session::flash('danger', 'User limit reached for your current plan. Please upgrade to add more users.');
            return redirect()->back();
        }

        $this->validate($request, [
            'username'      => 'required|string|max:45',
            'email'         => 'required|email|max:150|unique:users,email',
            'fk_idSecurity' => 'required|integer|exists:securities,idSecurity',
            'department'    => 'required|string|max:45',
        ]);

        $tempPassword = str_random(12);

        User::create([
            'username'        => $request->username,
            'email'           => $request->email,
            'password'        => bcrypt($tempPassword),
            'organization_id' => $org->id,
            'fk_idSecurity'   => $request->fk_idSecurity,
            'department'      => $request->department,
            'is_org_admin'    => $request->has('is_org_admin') ? 1 : 0,
            'photo'           => 'default.png',
            'remember_token'  => str_random(10),
        ]);

        Session::flash('success', "User created. Temporary password: <strong>{$tempPassword}</strong> — share this with the user.");
        return redirect()->route('admin.users');
    }

    public function editUser($id)
    {
        $org       = Auth::user()->organization;
        $editUser  = User::where('organization_id', $org->id)->findOrFail($id);
        $roles     = Security::all();

        return view('admin.users.edit', compact('editUser', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $org      = Auth::user()->organization;
        $editUser = User::where('organization_id', $org->id)->findOrFail($id);

        $this->validate($request, [
            'username'      => 'required|string|max:45',
            'fk_idSecurity' => 'required|integer|exists:securities,idSecurity',
            'department'    => 'required|string|max:45',
        ]);

        $editUser->update([
            'username'      => $request->username,
            'fk_idSecurity' => $request->fk_idSecurity,
            'department'    => $request->department,
            'is_org_admin'  => $request->has('is_org_admin') ? 1 : 0,
        ]);

        if ($request->filled('password')) {
            $editUser->update(['password' => bcrypt($request->password)]);
        }

        Session::flash('success', 'User updated successfully.');
        return redirect()->route('admin.users');
    }

    public function destroyUser($id)
    {
        $org      = Auth::user()->organization;
        $editUser = User::where('organization_id', $org->id)->findOrFail($id);

        if ($editUser->idUser === Auth::user()->idUser) {
            Session::flash('danger', 'You cannot delete your own account.');
            return redirect()->route('admin.users');
        }

        $editUser->delete();
        Session::flash('success', 'User removed.');
        return redirect()->route('admin.users');
    }

    public function settings()
    {
        $org = Auth::user()->organization;
        return view('admin.settings', compact('org'));
    }

    public function updateSettings(Request $request)
    {
        $org = Auth::user()->organization;

        $this->validate($request, [
            'name'    => 'required|string|max:150',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string',
        ]);

        $org->update($request->only(['name', 'phone', 'address']));

        Session::flash('success', 'Organization settings updated.');
        return redirect()->route('admin.settings');
    }
}
