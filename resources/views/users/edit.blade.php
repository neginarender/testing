@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            @can('users.edit')
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input  type="text" class="form-control" name="name"  placeholder="Name" value="{{ $user->name }}" required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input  type="email" class="form-control" name="email"  placeholder="Email" value="{{ $user->email }}" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" 
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->name, $userRole)  ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                @can('users.update')
                    <button type="submit" class="btn btn-primary">Update</button>
                @endcan
                <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</button>
            </form>
            @endcan
        </div>

    </div>
@endsection