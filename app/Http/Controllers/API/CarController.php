<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CarController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCars(): JsonResponse
    {
        $cars = Car::all();
    
        return $this->sendResponseData($cars , 'Cars retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCar(Request $request): JsonResponse
    {

        
        $validator = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error.', $validator->errors());       
        }

        $input = $request->all();
        $car = Car::create($input);
        $success['name'] =  $car->make;
   
        return $this->sendResponseData($success, 'Product created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSingleCar($id): JsonResponse
    {
        $car = Car::find($id);
  
        if (is_null($car)) {
            return $this->sendError('Car not found.');
        }
   
        return $this->sendResponseData($car, 'Car retrieved successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCar($id): JsonResponse
    {
        $car = Car::find($id);
        $car->delete();
   
        return $this->sendError('Car Deleted Succesfully.');
    }
}
