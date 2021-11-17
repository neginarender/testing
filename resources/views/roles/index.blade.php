@extends('layouts.admin_app')

@section('content')
    
    <h1 class="mb-3">Manage Roles</h1>

    <div class="bg-light p-4 rounded">
        <h1>Roles</h1>
        <div class="lead">
            Manage your roles
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add role</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th>No</th>
             <th>Name</th>
             <th colspan="3">Action</th>
          </tr>
            @can('roles.index')

            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @can('roles.show')
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                    @endcan
                </td>
                <td>
                    @can('roles.edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('roles.destroy')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
            @endcan
        </table>

        <div class="d-flex">
            {!! $roles->links() !!}
        </div>

    </div>
@endsection