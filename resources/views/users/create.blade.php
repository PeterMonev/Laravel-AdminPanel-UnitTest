@extends('adminlte::page')

@section('title', 'User - Create')

@section('content_header')
    <h1>Create New User</h1>
@stop

@section('content')
<div class="container">
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="name" name="password" placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="Enter phone number">
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@stop