<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

use App\Models\Routes;
use Illuminate\Auth\Events\Login;

Route::get('/', 'Landing\LandingPageController@index');
Route::get('/tentang-kami', function () {
    return view('home.tentang-kami'); 
});
Route::get('/data/curah-hujan', function () {
    return view('home.data.curah-hujan'); 
});
Route::get('/data/irigasi', function () {
    return view('home.data.irigasi'); 
});
Route::get('/data/jenis-tanah', function () {
    return view('home.data.jenis-tanah'); 
});
Route::get('/data/kemiringan', function () {
    return view('home.data.kemiringan'); 
});
Route::get('/data/panen', function () {
    return view('home.data.panen'); 
});
Route::get('/data/kab-kota', function () {
    return view('home.data.kab-kota'); 
});
Route::get('/kontak-kami', function () {
    return view('home.kontak-kami'); 
});

try {
    $routes= Routes::where('guard','web')->get()->toArray();
    
    foreach ($routes as $key ) {
        # code...
            
        $arr=explode(',', $key['middleware']);
        $method=$key['method'];
        $url=$key['url'];
        $path=$key['route'];
        if ($key['permission']!='') {
            # code...
            $perm="permissionAccess:";
            if($key['type']!='data')
            {
                $perm='permission:';
            }
            array_push($arr, $perm.$key['permission']);
        }
        Route::$method($url,$path)->middleware($arr);
    }
    // dd('Route::'.$method.'('.$url.','.$path.')->middleware('.$arr.');');
    // dd($routes);
} catch (Exception $e) {
    
}
