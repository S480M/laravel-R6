<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassData;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassData::get();

        $classes = ClassData::get();

        return view('classes', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_class');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation of the data
        $data = $request->validate([
            'className ' => 'required|string',
            'capacity' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'timeFrom' => 'required|date_format:H:i',
            'timeTo' => 'required|date_format:H:i|after:timeFrom',
            
        ]);
        //dd($data);
        $data['isFulled'] = isset($request->isFulled);

        
        //dd($request);
            // $className = 'art';
            // $capacity = 10;
            // $isFulled = true;
            // $price = 100;
            // $timeFrom =9;
            // $timeTo =10;

            // ClassData::create([
            //     'className' => $className,
            //     'capacity' => 10,
            //     'isFulled' => $isFulled,
            //     'price' => $price,
            //     'timeFrom' => $timeFrom,
            //     'timeTo' => $timeTo,
            //     ]);

            // if(isset($request->isFulled)){
            //     $isFulled = true;
            // } else {
            //     $isFulled = false;
            // }

            $data = [
                //'key(column name)' => 'value'
                    'className' => $request->className,
                    'capacity' => $request->capacity,
                    'isFulled' => isset($request->isFulled),
                    'price' => $request->price,
                    'timeFrom' => $request->timeFrom,
                    'timeTo' => $request->timeTo,
                ];
                
                ClassData::create($data);
                
            return redirect()->route('classes.index');
            //return "Data added successfully";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = ClassData::findOrFail($id);
        return view('class_details', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = ClassData::findOrFail($id);
        return view('edit_class', compact('class'));
        //return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation of the data
        $data = $request->validate([
            'className ' => 'required|string',
            'capacity' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'timeFrom' => 'required|date_format:H:i',
            'timeTo' => 'required|date_format:H:i|after:timeFrom',
            
            ]);
            //dd($data);
        $data['isFulled'] = isset($request->isFulled);

        $data = [
            'className' => $request->className,
            'capacity' => $request->capacity,
            'isFulled' => isset($request->isFulled),
            'price' => $request->price,
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            ];
            
            ClassData::where('id', $id)->update($data);
            return redirect()->route('classes.index');
            //return "data updated successfully";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        ClassData::where('id', $id)->delete();
        
        return redirect()->route('classes.index');
        //return "data deleted successfully" ;
    }
    
    
    public function showDeleted() {
        $classes = ClassData::onlyTrashed()->get();

        return view('trashedClasses', compact('classes'));
    }

    public function restore(string $id) {
        
        
        ClassData::where('id', $id)->restore();
        return redirect()->route('classes.showDeleted');
    }

    public function forceDelete(string $id) {
        
        
        ClassData::where('id', $id)->forceDelete();
        return redirect()->route('classes.index');
    }

}

