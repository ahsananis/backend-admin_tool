<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api/'],function () use ($router) {
  
    //DepartmentContoller_Routes
    $router->post('/create/department','DepartmentController@store');
    $router->get('/departments','DepartmentController@getDepartments');
    $router->post('/update/department/{id}','DepartmentController@update');
    $router->post('/dltdepartment/{id}','DepartmentController@dltDepartment');

    //ShiftController_Routes
    $router->post('/create/shift','ShiftController@store');
    $router->get('/shifts','ShiftController@getShifts');
    $router->post('/update/shift/{id}','ShiftController@update');
    $router->post('/dltShift/{id}','ShiftController@dltShift');

    //EmployeeController_Routes
    $router->post('/create/employee','EmployeeController@store');
    $router->get('/employees','EmployeeController@getEmployees');
    $router->post('/update/employee/{id}','EmployeeController@update');
    $router->post('/dltEmployee/{id}','EmployeeController@dltEmployee');
    $router->post('/import/employee','EmployeeController@import');

    //SheetController_Routes
    $router->post('/importexcel', 'SheetController@importExcel');
    $router->get('/exportexcel/{type}', 'SheetController@downloadExcel');
    $router->post('/importexcel/all', 'SheetController@late');
    $router->get('/exportexceldata/{id}', 'SheetController@show');
    $router->get('/exportexceldata/show', 'SheetController@show');

    //Email_Route
    $router->post('/testmail','SheetController@sendEmail');

    //Authentication_Register_and_Login_Routes
    $router->post('/register','UserController@register');
    $router->post('/login','UserController@login');
    $router->get('/users','UserController@getUsers');
    
});








//Middleware

$router->group(['prefix'=>'admin','middleware'=>['auth','role:admin']], function() use($router)
{
    $router->post('user', function()
    {
        return "I am Anonymous User";
    });

    $router->post('profile', function()
    {
        return response()->json(array(['message'=>'Hello, Message'],['message'=>'Bye, Message'],['message'=>'Good, Bye']));
    });
});



//$router->post('/login',['middleware'=>'auth', 'uses'=>'UserController@login']);
//$router->post('/role',['middleware'=>['auth','role:admin'],'UserController@login']);
