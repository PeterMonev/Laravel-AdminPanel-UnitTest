<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index()
    {
        // Get all cars for index blade view
        $cars = Car::with('user')->orderBy('id', 'desc')->paginate(10);

        return view('cars.dashboard', [
            'cars' => $cars,
        ]);
    }


    public function create()
    {
        return view('cars.create');
    }

    // Store car on post request
    public function store(request $request)
    {
        //Validate post request 
        $this->validate($request, [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
        ]);

        // Store car in database
        $Cars = new Car([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
        ]);

        // Assign the user_id based on the currently authenticated user
        $Cars->user_id = auth()->user()->id;

        $Cars->save();

        return redirect()->route('admin.car.index')->with('success', 'Car created successfully');
    }


    public function edit($id){
        //Get cars by id for edit 
        $car = Car::find($id);

        return view('cars.edit',[
            'car' => $car
        ]);
    }



    public function update(request $request,$id){
        
        // Validation
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        
        $CaR = Car::find($id);
        $CaR->make = $request->make;
        $CaR->model = $request->model;
        $CaR->year = $request->year;
        $CaR->save();

        return redirect()->route('admin.car.index')->with('success', 'Car was updated successfully');
    }



    public function destroy(request $request,$id){

        $car = Car::find($id);

        $car->delete();

        return redirect()->route('admin.car.index')->with('success', 'Car was deleted successfully');
    }
}
