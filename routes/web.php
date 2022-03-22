<?php

use App\Entities\House;
use App\Repositories\RoomAmenityRepository;
use App\Repositories\RoomPictureRepository;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
   $room = \App\Entities\Room::where(['id' => 1, 'room_name' => 'Số phòng 1'])->get();

   dd($room);

});
