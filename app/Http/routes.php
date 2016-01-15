<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Really we need a default page != home?
Route::get('/', function () {
    return redirect('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    // Routes relative to authentication
    Route::auth();

    // When a user is authenticated
    Route::get('/home', 'HomeController@index');

    // Configuration routes
    Route::get('configuracion/datos', 'InstitutionController@index');
    Route::get('configuracion/parametros', 'ParameterController@index');
    Route::get('configuracion/anos-lectivos', 'SchoolYearController@index');
    Route::get('configuracion/ano-lectivo/{id}', 'PeriodController@index');
    Route::get('configuracion/periodo-lectivo/{id}', 'UnitController@index');
    Route::get('configuracion/grados', 'GradeController@index');
    Route::get('configuracion/grado/{id}', 'SectionController@index');
    Route::get('configuracion/cursos', 'CourseController@index');
    Route::get('configuracion/cursos/asignar/{grade?}', 'CourseGradeController@index');

    // SchoolYear CRUD
    Route::post('ano-lectivo/registrar', 'SchoolYearController@store');

    // Period CRUD
    Route::post('periodo/registrar', 'PeriodController@store');
    Route::put('periodo/editar', 'PeriodController@update');
    Route::get('periodo/eliminar/{id}', 'PeriodController@destroy');

    // Unit CRUD
    Route::post('unidad/registrar', 'UnitController@store');
    Route::put('unidad/editar', 'UnitController@update');
    Route::get('unidad/eliminar/{id}', 'UnitController@destroy');

    // Grade CRUD
    Route::post('grado/registrar', 'GradeController@store');
    Route::put('grado/editar', 'GradeController@update');
    Route::get('grado/eliminar/{id}', 'GradeController@destroy');

    // Section CRUD
    Route::post('seccion/registrar', 'SectionController@store');
    Route::put('seccion/editar', 'SectionController@update');
    Route::get('seccion/eliminar/{id}', 'SectionController@destroy');

    // Course CRUD
    Route::post('curso/registrar', 'CourseController@store');
    Route::put('curso/editar', 'CourseController@update');
    Route::get('curso/eliminar/{id}', 'CourseController@destroy');

    // CourseGrade CRUD
    Route::post('asociar/curso/{course}/grado/{grade}', 'CourseGradeController@store');
    Route::get('desasociar/curso/{course}/grado/{grade}', 'CourseGradeController@destroy');

    // Users registration routes
    Route::get('alumnos/registrar', 'StudentController@create');
    Route::get('docentes/registrar', 'TeacherController@create');
    Route::get('personal/registrar', 'WorkerController@create');

});
