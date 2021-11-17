@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show user</h1>
        <div class="lead"></div>
        
        <div class="container mt-4">
            <div>
                Name: {{ auth()->user()->name }}
            </div>
            <div>
                Email: {{ auth()->user()->email }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('profiles.edit', auth()->id()) }}" class="btn btn-info">Edit</a>
    </div>
@endsection