@extends('adminlte::page')

@section('title', 'Car - Create')

@section('content_header')
    <h1>Create new Car</h1>
@stop

@section('content')
<div class="container">
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="make">Car Make:</label>
            <input type="text" class="form-control" id="make" name="make" placeholder="Enter car make">
        </div>
        <div class="form-group">
            <label for="model">Car Model:</label>
            <input type="text" class="form-control" id="model" name="model" placeholder="Enter car model">
        </div>
        <div class="form-group">
            <label for="year">Car Year:</label>
            <input type="number" class="form-control" id="year" name="year" placeholder="Enter car year">
        </div>
        <button type="submit" class="btn btn-primary">Create Car</button>
    </form>
</div>
@stop