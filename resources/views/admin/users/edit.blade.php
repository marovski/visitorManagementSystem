@extends('main')
@section('title', '| Edit User')

@section('content')
<div class="container">
    <h2>Edit User: {{ $editUser->username }}</h2>
    <a href="{{ route('admin.users') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Back to Users</a>
    <hr>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="{{ route('admin.users.update', $editUser->idUser) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="{{ old('username', $editUser->username) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" name="department" value="{{ old('department', $editUser->department) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="fk_idSecurity" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->idSecurity }}" {{ $editUser->fk_idSecurity == $role->idSecurity ? 'selected' : '' }}>
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
                            <input type="checkbox" name="is_org_admin" value="1" {{ $editUser->is_org_admin ? 'checked' : '' }}>
                            Admin Panel Access
                        </label>
                    </div>
                    <div class="form-group">
                        <label>New Password <small class="text-muted">(leave blank to keep current)</small></label>
                        <input type="password" class="form-control" name="password" placeholder="New password...">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
