@extends('layouts.admin_app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Add new permission</h2>
        <div class="lead">
            Add new permission.
        </div>
        <div class="container mt-4">
            @can('permissions.create')
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ old('name') }}" 
                            type="text" 
                            class="form-control" 
                            name="name" 
                            placeholder="Name" required>

                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    @can('permissions.store')
                        <button type="submit" class="btn btn-primary">Save permission</button>
                    @endcan
                    <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                </form>
            @endcan
        </div>
    </div>
@endsection