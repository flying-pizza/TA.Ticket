<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

Route::post('/check-ticket', [TicketController::class, 'checkTicket']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});