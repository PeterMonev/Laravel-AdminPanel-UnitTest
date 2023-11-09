@extends('adminlte::page')

@section('title', 'Users - Edit')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
<div class="container">
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone_number }}">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@stop