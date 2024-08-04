<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClassController;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

Route::get('login' , [ExampleController::class, 'login']);
Route::get('cv' , [ExampleController::class, 'cv']);

Route::prefix('cars')->group(function(){
    Route::get('', [CarController::class, 'index'])->name('cars.index');
    Route::get('create', [CarController::class, 'create'])->name('cars.create');
    Route::post('', [CarController::class, 'store'])->name('cars.store');
    Route::get('{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
//  Route::get('cars/car}/edit', [CarController::class, 'edit'])->name('cars.edit');  (laravel11)
    Route::put('{id}', [CarController::class, 'update'])->name('cars.update');
    Route::get('{id}/show', [CarController::class, 'show'])->name('cars.show');
    Route::delete('{id}/delete', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('trashed', [CarController::class, 'showDeleted'])->name('cars.showDeleted');
    Route::patch('{id}', [CarController::class, 'restore'])->name('cars.restore');
    Route::delete('{id}', [CarController::class, 'forceDelete'])->name('cars.forceDelete');
//  Route::resource('cars', CarController::class); ** php artisan r:l
    Route::post('upload', [CarController::class, 'upload'])->name('cars.upload');
});

Route::get('uploadForm', [ExampleController::class, 'uploadForm']);
Route::post('upload', [ExampleController::class, 'upload'])->name('upload');


Route::get('classes', [ClassController::class, 'index'])->name('classes.index');
Route::get('classes/create', [ClassController::class, 'create'])->name('classes.create');
Route::post('classes', [ClassController::class, 'store'])->name('classes.store');
Route::get('classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
Route::put('classes/{id}', [ClassController::class, 'update'])->name('classes.update');
Route::get('classes/{id}/show', [ClassController::class, 'show'])->name('classes.show');
Route::delete('classes/{id}/delete', [ClassController::class, 'destroy'])->name('classes.destroy');
Route::get('classes/trashed', [ClassController::class, 'showDeleted'])->name('classes.showDeleted');
Route::patch('classes/{id}', [ClassController::class, 'restore'])->name('classes.restore');
Route::delete('classes/{id}', [ClassController::class, 'forceDelete'])->name('classes.forceDelete');

//session6
// get request: show data
// post: submit new data to server
// put: update data in server
// patch
//delete: delete data from server


Route::get('/', function () {
    return view  ('welcome');
});


Route::get('w', function () {
    return "Hello Laravel!!";
});

// Route::get('cars/{id?}', function($id=0) {
//     return "car number is ". $id;
// })->where([
//     'id' => '[0-9]+'
    
// ]);

// Route::get('cars/{id?}', function($id=0) {
//     return "car number is ". $id;
// })->whereNumber('id');

// Route::get('user/{name}/{age}', function($name, $age){
//     return "Username is " . $name . " and age is " . $age;
// })->whereAlpha('name')->whereNumber('age');
 // })->where(
//     [
//     'name' => '[a-zA-Z]+' ,
//     'age'  => '[0-9]+'
//     ]
//     );



// Route::get('user/{name}/{age?}', function($name, $age=0){
//     if($age==0){
//         return "Username is " . $name ;
//     }else{ 
//         return "Username is " . $name . " and age is " . $age;
//     }
// })->where(
//         [
//         'name' => '[a-zA-Z]+' ,
//         'age'  => '[0-9]+'
//         ]
//         );

Route::get('user/{name}', function($name) {
    return "username is ". $name; 
})->whereIn('name', ['Salma', 'Sadan']);



//route prefix (important)
// company/IT
// company/users
// company/
Route::prefix('company')->group(function() {

    Route::get('',function() {
        return 'company Index';
    });

    Route::get('IT',function(){
        return 'company IT';
    });

    Route::get('users',function(){
        return 'company users';
    });
});



// Route::prefix('accounts')->group(function() {

//     Route::get('',function() {
//         return 'accounts page';
//     });

//     Route::get('admins',function() {
//         return 'accounts admin';
//     });

//     Route::get('users',function(){
//         return 'accounts user';
//     });
// });

// Route::prefix('cars')->group(function(){
//     Route::get('', function () {
//         return "cars index";
//     });

//     Route::prefix('usa')->group(function(){
//         Route::get('ford', function () {
//             return "cars ford";
//         });
//     Route::get('tesla', function () {
//         return "cars tesla";
//         });
//     });

//     Route::prefix('ger')->group(function(){
//         Route::get('mercedes', function () {
//             return "cars mercedes";
//         });
//     Route::get('audi', function () {
//         return "cars audi";
//         });
//     Route::get('volkswagen', function () {
//     return "cars volkswagen";
//     });
//     });
// });


// Route::fallback(function(){
//     return redirect('/');
// });


Route::get('/', function () {
    return view  ('welcome');
});

Route::get('cv', function (){
    return view('cv');
});
//Route::view('cv', 'cv'); (the same bs e5tesar)
//Route::get('cv', [ExampleController::class, 'cv']);  3mlna 2l function fi controller


Route::get('link', function (){
    $url = route('w');
    return "<a href='$url'>go to welcome</a>";
});

Route::get('welcome', function (){
    return "welcome to laravel";
})->name('w');


Route::get('login', function(){
    //return view('login');  7tenaha fi examplecontroller
});
// hnsheel el function f htkoon Route::get('login',);
// Route::get('login' , [ExampleController::class, 'login']);

//Route::get('login' , [ExampleController::class, 'login']);
    Route::post('logindone', function() {
        return "logincheck";
    })->name('logindone');


Route::get('contactUs' , [ExampleController::class, 'contactUs']);
Route::post('data',[ExampleController::class, 'recieve'])->name('information');


























