@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($role->name) }} Role</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">

            <h3>Assigned permissions</h3>

            <table class="table table-striped">
                <thead>
                    <th scope="col" width="20%">Name</th>
                    <th scope="col" width="1%">Guard</th> 
                </thead>

                @can('roles.show')
                    @foreach($rolePermissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                @endcan
            </table>
        </div>

    </div>
    <div class="mt-4">
        @can('roles.edit')
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
        @endcan
        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
    </div>
@endsection