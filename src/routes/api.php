<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

Route::post('/upload', function (Request $request) {
  $file = $request->file('file');

  if (blank($file)) {
    return response()->json(['message' => 'file is required'], 400);
  }

  $storageFile = Storage::disk('public')->putFile('', $file);

  if(!$storageFile) {
    return response()->json(['message' => 'upload error'], 500);
  }

  return response()->json(['url' => env('APP_URL') . '/storage/' . $storageFile]);
});
