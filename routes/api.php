<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BoitierController;
use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\AlertController;
use App\Http\Controllers\API\EmailController;
use App\Http\Controllers\API\TechRapportController;

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

    Route::post('/login', [AuthController::class, 'login']); //verfied route -> return token
    
    
    // Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']); create cascade on adress_users -> boitiers -> tech rapports
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        
        //AUTHCONTROLLER
        //GET
        Route::get('/logout', [AuthController::class, 'logout']);
        //POST
        Route::post('/register', [AuthController::class, 'register']);
        //USERCONTROLLER
        //GET
        Route::get('/showUserList', [UserController::class, 'showUserList']);
        Route::get('/getAuthUser', [UserController::class, 'getAuthUser']);
        Route::get('/showUser/{id}', [UserController::class, 'showUser']);
        Route::get('/getUserBelongsToBoitier', [UserController::class, 'getUserBelongsToBoitier']);
        // Count
        Route::get('/countTotalCustomer', [UserController::class, 'countTotalCustomer']);
        Route::get('/countTotalConcess', [UserController::class, 'countTotalConcess']);
        Route::get('/countTotalReseller', [UserController::class, 'countTotalReseller']);
        Route::get('/countTotalTech', [UserController::class, 'countTotalTech']);
        // List
        Route::get('/showCustomerList', [UserController::class, 'showCustomerList']);
        Route::get('/showResellerList', [UserController::class, 'showResellerList']);
        Route::get('/showConcessList', [UserController::class, 'showConcessList']);
        Route::get('/showTechList', [UserController::class, 'showTechList']);

        Route::get('/showResellerListForAssign', [UserController::class, 'showResellerListForAssign']);
        Route::get('/countResBelongToCons/{id}', [UserController::class, 'countResBelongToCons']);
        Route::get('/showConcessListForAssign', [UserController::class, 'showConcessListForAssign']);
        //all
        Route::get('/showChildListBelongToParent/{id}', [UserController::class, 'showChildListBelongToParent']);
        //POST
        Route::post('/updatePassword', [UserController::class, 'updatePassword']);
        Route::post('/updateParentName/{id}', [UserController::class, 'updateParentName']);
        Route::post('/updateUserInfo/{id}', [UserController::class, 'updateUserInfo']);
        Route::post('/updateEmail', [UserController::class, 'updateEmail']);
        //BOITIERCONTROLLER
        //GET
        Route::get('/showBoitierList', [BoitierController::class, 'showBoitierList']);
        Route::get('/showBoitier/{id}', [BoitierController::class, 'showBoitier']);
        Route::get('/showContract/{id}', [BoitierController::class, 'showContract']);
        Route::get('/showCustomerListForAssign', [BoitierController::class, 'showCustomerListForAssign']);
        Route::get('/getBoitierBelongToUser/{id}', [BoitierController::class, 'getBoitierBelongToUser']);
        // Route::get('/countTotalBoitier', [BoitierController::class, 'countTotalBoitier']);
        Route::get('/countTotalActiveInactiveBoitier', [BoitierController::class, 'countTotalActiveInactiveBoitier']);
        Route::get('/countTotalBoitierUsers/{id}', [BoitierController::class, 'countTotalBoitierUsers']);
        Route::get('/showAllPosition', [BoitierController::class, 'showAllPosition']);
        // USER CONDITION
        // Route::get('/showBoitierListUsers/{id}', [BoitierController::class, 'showBoitierListUsers']);
        // TECH CONDITION
        // Route::get('/showBoitierListForTech/{id}', [BoitierController::class, 'showBoitierListForTech']);
        //POST
        Route::post('/storeBoitier', [BoitierController::class, 'storeBoitier']);
        Route::post('/updateBoitierInfo/{id}', [BoitierController::class, 'updateBoitierInfo']);
        Route::post('/updateCustomerName/{id}', [BoitierController::class, 'updateCustomerName']);
        //RAPPORTCONTROLLER
        //GET
        Route::get('/showRapportImage/{id}', [TechRapportController::class, 'showRapportImage']);
        Route::delete('/deleteRapportImage/{id}/{filename}', [TechRapportController::class, 'deleteRapportImage']);

        //POST
        Route::post('/addRapportImage/{id}', [TechRapportController::class, 'addRapportImage']);
        //DATACONTROLLER
        //GET
        Route::get('/getInternData/{id}', [DataController::class, 'getInternData']);
        Route::get('/getConfig/{id}', [DataController::class, 'getConfig']);
        //
        Route::get('/getAllChartData/{id}', [DataController::class, 'getAllChartData']);
        //
        Route::get('/showBoitierLog/{id}', [DataController::class, 'showBoitierLog']);
        Route::get('/exportBoitierLog/{id}', [DataController::class, 'exportBoitierLog']);
        //
        //ALERTCONTROLLER
        Route::get('/showAlertList', [AlertController::class, 'showAlertList']);
        Route::get('/lastAlert', [AlertController::class, 'lastAlert']);
        Route::get('/lastAlertBelongToUser/{id}', [AlertController::class, 'lastAlertBelongToUser']);
        Route::get('/lastAlertByBoitier/{id}', [AlertController::class, 'lastAlertByBoitier']);
        Route::get('/everyAlertByBoitier/{id}', [AlertController::class, 'everyAlertByBoitier']);
        Route::post('/updateAlertList/{id}', [AlertController::class, 'updateAlertList']);
        Route::get('/exportAlertLog/{id}', [AlertController::class, 'exportAlertLog']);
        //MAIL SYSTEM
        Route::post('/sendAlerts/{id}', [EmailController::class, 'sendAlerts']);
        //MQTT
        
    });

    //no login exception
    // Route::get('/image/{id}/{filename}', 'TechRapportController@serveImage');
    Route::get('/image/{id}/{filename}', [TechRapportController::class, 'serveImage']);
    
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
    Route::post('/handle', [DataController::class, 'handle']);