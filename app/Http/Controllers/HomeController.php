<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Transaction;
use App\Models\Type;
use App\Repositories\ImageRepository;
use App\Repositories\RoomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $types = Type::all();
        $rooms = Room::all();
        return view('Hotel.home',compact('types','rooms'));
    }
}
