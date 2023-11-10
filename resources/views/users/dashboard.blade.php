@extends('adminlte::page')

@section('title', 'Users - Dashboard')

@section('content_header')
    <h1>User Management Dashboard</h1>
@stop

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.user.destroy', ['id' => $user->id]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@stop
