<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all cars from database
        //return view all cars, cars data
        //select * from cars;
        $cars = Car::get();
        
        return view('cars', compact('cars'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_car');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'assets/images';
        $request->image->move($path, $file_name);
        return 'Uploaded';
        
        
        //validation of the data
        $data = $request->validate([
            'carTitle' => 'required|string',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        //dd($data);
        $data['published'] = isset($request->published);

        //dd($request);
        
        if(isset($request->published)){
            $pub = true;
        } else {
            $pub = false;
        }

        Car::create($data);
        //  'key(column name)' => 'value'
            // 'carTitle' => $request->carTitle,
            // 'description' => $request->description,
            // 'price' => $request->price,
            // 'published' => $pub,
            //'published' => isset($request->published),  another answer without using if condition
        //]);
        
        //Car::create($data);
        
        //dd($request);
        // $carTitle = 'BMW';
        // $price = 12;
        // $description = "test";
        // $published = true;
        
        // Car::create([
        //     'carTitle' => $carTitle,
        //     'price' => 12,
        //     'description' => $description,
        //     'published' => $published,
        // ]);
        return redirect()->route('cars.index');
        //return "Data added successfully";

    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        return view('car_details', compact('car'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    //public function edit(Car $car) without findOrFail (laravel11)
    {
        
        $car = Car::findOrFail($id);
        return view('edit_car', compact('car'));
        //return $id;
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation of the data
        $data = $request->validate([
            'carTitle' => 'required|string',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            
        ]);
        //dd($data);
        $data['published'] = isset($request->published);
        
        //dd($request, $id);
        
        // $request ==> data to be updated
        // $id
        
            $data = [
                'carTitle' => $request->carTitle,
                'description' => $request->description,
                'price' => $request->price,
                'published' => isset($request->published),
            ];
            
            Car::where('id', $id)->update($data);
            
            return redirect()->route('cars.index');
            //return "data updated successfully";
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Car::where('id', $id)->delete();
        
        return redirect()->route('cars.index');
        //return "data deleted successfully" ;
    }
    
    public function showDeleted() {
        $cars = Car::onlyTrashed()->get();
        
        return view('trashedCars', compact('cars'));
        
    }

    public function restore(string $id) {
        Car::where('id', $id)->restore();
        
        return redirect()->route('cars.showDeleted');
    }

    public function forceDelete(string $id) {
        Car::where('id', $id)->forceDelete();
        
        return redirect()->route('cars.index');
    }
}
