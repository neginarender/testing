@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Manage user</h1>
    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            Manage your users here.
            @can('users.create')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
            @endcan
        </div>
        
        <div class="mt-2">
            @include('layouts.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Roles</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @can('users.create')
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('users.show')
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                            @endcan
                        <td>
                            @can('users.edit')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                            @endcan
                        <td>
                            @can('users.destroy')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                @endcan
            </tbody>
        </table>

        <div class="d-flex">
            {!! $users->links() !!}
        </div>

    </div>
@endsection