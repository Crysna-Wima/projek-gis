<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Routes;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
try {
    $routes= Routes::where('guard','api')->get()->toArray();
    
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
