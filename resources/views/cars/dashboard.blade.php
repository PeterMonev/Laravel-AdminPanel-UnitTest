@extends('adminlte::page')

@section('title', 'Car - Dashboard')

@section('content_header')
    <h1>Car Management Dashboard</h1>
@stop

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Car Year</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($cars as $car)
            <tr>
                <tr>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.car.edit', ['id' => $car->id]) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('admin.car.destroy', ['id' => $car->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
                    </td>
                </tr>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@stop
