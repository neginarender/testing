@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show user</h1>
        <div class="lead"></div>
        
        <div class="container mt-4">
            <div>
                Name: {{ $user->name }}
            </div>
            <div>
                Email: {{ $user->email }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        @can('users.edit')
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
        @endcan
        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
    </div>
@endsection