@extends('adminlte::page')

@section('title', 'Car - Edit')

@section('content_header')
    <h1>Edit Car</h1>
@stop

@section('content')
<div class="container">
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Brand:</label>
            <input type="text" class="form-control" id="make" name="make" value="{{ $car->make }}">
        </div>

        <div class="form-group">
            <label for="name">Model:</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}">
        </div>

        <div class="form-group">
            <label for="name">Year:</label>
            <input type="text" class="form-control" id="year" name="year" value="{{ $car->year }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Car</button>
    </form>
</div>
@stop