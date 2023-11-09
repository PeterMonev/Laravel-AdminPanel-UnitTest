<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a paginated list of cars.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch a paginated list of cars ordered by ID in descending order
        $cars = Car::with('user')->orderBy('id', 'desc')->paginate(10);

        // Render the 'cars.dashboard' view and pass the list of cars to it
        return view('cars.dashboard', [
            'cars' => $cars,
        ]);
    }

    /**
     * Display the car creation form.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Render the 'cars.create' view for creating a new car
        return view('cars.create');
    }

    /**
     * Store a newly created car in the database.
     * 
     * @param Request $request The incoming request containing car data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with validation errors or to the car index page.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
        ]);

        if ($validator->fails()) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }
     
        // Create a new Car instance and populate it with the request data
        $car = new Car([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
        ]);

        // Set the user ID for the car based on the currently authenticated user
        $car->user_id = auth()->user()->id;
        $car->save();

        // Redirect to the car index page with a success message
        return redirect()->route('admin.car.index')->with('success', 'Car created successfully');
    }

    /**
     * Display the car edit form.
     * 
     * @param int $id The ID of the car to edit.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the car by its ID
        $car = Car::findOrFail($id);

        // Render the 'cars.edit' view and pass the car data to it
        return view('cars.edit', [
            'car' => $car
        ]);
    }

    /**
     * Update a car in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id The ID of the car to update.
     * @return \Illuminate\Http\RedirectResponse Redirects back with validation errors or to the car index page.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data for updating a car
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        if ($validator->fails()) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the car by its ID
        $car = Car::find($id);

        if (!$car) {
            // If the car is not found, redirect to the car index page with an error message
            return redirect()->route('admin.car.index')->with('error', 'Car not found.');
        }

        // Update the car's data based on the request input
        $car->update([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
        ]);

        // Redirect to the car index page with a success message
        return redirect()->route('admin.car.index')->with('success', 'Car was updated successfully');
    }

    /**
     * Delete a car from the database.
     * 
     * @param int $id The ID of the car to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects back with errors for non-existing ID or to the car index page.
     */
    public function destroy($id)
    {
        // Find the car by its ID
        $car = Car::find($id);

        if ($car) {
            // If the car is found, delete it and redirect to the car index page with a success message
            $car->delete();
            return redirect()->route('admin.car.index')->with('success', 'Car was deleted successfully');
        }
    
        // If the car is not found, redirect to the car index page with an error message
        return redirect()->route('admin.car.index')->with('error', 'Car not found or already deleted');
    }
}
