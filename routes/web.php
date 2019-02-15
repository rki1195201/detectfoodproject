<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;

Auth::routes();

Route::get('api/users/{user}',function(User $user){
    return $user->email;
});

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
    return 'test file';
});

//redirect route
Route::middleware(['auth'])->group(function(){
    Route::get('/user/{id?}',function($id=null){
        if(!is_null($id)){
            return redirect()->route('profile');
        }
        else{
            return 'no user found.';
        }
    });
    
    Route::get('/student/profile',function(){
        return 'user founded.';
    })->name('profile');
    
});
//to here

//Api controller
Route::resource('api','APIController');

//One controller
Route::get('/one/{id}','OneController');

//db
Route::get('/insert',function(){
    DB::insert('insert into users(name,email,password,remember_token) values(?,?,?,?)',['tom','tom234@hotmail.com','123456','123456']);
});

Route::get('/read',function(){
    $output = User::all();
    return $output;
    /*foreach($output as $yo){
        return $yo;
    }*/
});

Route::get('/insertdata',function(){
    $post = new User;
    $post->name = 'alpha';
    $post->password = 'sdadadas';
    $post->email = 'alpha123@gmail.com';
    $post->save();
});

Route::get('/run',function(){
    $output = shell_exec('py py/Check_Food.py py/Test_Images/testImg3.jpg');
    return $output;
});

Route::get('/findwhere',function(){
    $post = User::where('id',1)->orderBy('name','desc')->take(1)->get();
    return $post;
});

Route::get('/create',function(){
    User::create(['name'=>'koe','email'=>'koe123@gmail.com','password'=>'487eww8ehfd']);
});