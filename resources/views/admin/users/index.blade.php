@extends('main')
@section('title', '| Manage Users')

@section('content')
<div class="container">
    <h2><span class="glyphicon glyphicon-user"></span> Manage Users</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Back to Admin</a>
    <hr>

    <div class="row">
        {{-- Existing users table --}}
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Users ({{ $users->total() }} / {{ $org->plan->max_users == 0 ? '∞' : $org->plan->max_users }})</b></div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                            <tr>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->department }}</td>
                                <td>{{ $u->fk_idSecurity }}</td>
                                <td>{{ $u->is_org_admin ? '<span class="label label-warning">Admin</span>' : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $u->idUser) }}" class="btn btn-xs btn-primary">Edit</a>
                                    @if($u->idUser != Auth::user()->idUser)
                                    <form method="POST" action="{{ route('admin.users.destroy', $u->idUser) }}" style="display:inline"
                                        onsubmit="return confirm('Remove this user?')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-xs btn-danger">Remove</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        {{-- Add user form --}}
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Add New User</b></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" class="form-control" name="department" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="fk_idSecurity" required>
                                @foreach($roles as $role)
                                <option value="{{ $role->idSecurity }}">
                                    @if($role->superAdmin) Super Admin
                                    @elseif($role->meetingPermission) Staff
                                    @else Security Guard
                                    @endif
                                    (ID: {{ $role->idSecurity }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_org_admin" value="1"> Grant Admin Panel Access
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
