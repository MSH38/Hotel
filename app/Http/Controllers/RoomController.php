<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use App\Models\Customer;
use App\Models\User;
use App\Models\RoomStatus;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ImageRepository;
use App\Repositories\RoomRepository;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class RoomController extends Controller
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roomRepository->getRoomsDatatable($request);
        }
        return view('room.index');
    }

    public function create()
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        $view = view('room.create', compact('types', 'roomstatuses'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());

        return response()->json([
            'message' => 'Room ' . $room->number . ' created'
        ]);
    }

    public function show(Room $room)
    {
        $customer = [];
        $transaction = Transaction::where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()], ['room_id', $room->id]])->first();
        if (!empty($transaction)) {
            $customer = $transaction->customer;
        }
        return view('room.show', compact('customer', 'room'));
    }

    public function edit(Room $room)
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        $view = view('room.edit', compact('room', 'types', 'roomstatuses'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());

        return response()->json([
            'message' => 'Room ' . $room->number . ' udpated!'
        ]);
    }

    public function destroy(Room $room, ImageRepository $imageRepository)
    {
        try {
            $room->delete();

            $path = 'img/room/' . $room->number;
            $path = public_path($path);

            if (is_dir($path)) {
                $imageRepository->destroy($path);
            }

            return response()->json([
                'message' => 'Room number ' . $room->number . ' deleted!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Customer ' . $room->number . ' cannot be deleted! Error Code:' . $e->errorInfo[1]
            ], 500);
        }
    }
    public function displayRooms(Room $room,Customer $customer,CustomerRepository $customerRepository,Request $request)
    {
        // dd(request()->all());

        $types = Type::all();
        $rooms = Room::all();
        // $customer= Customer::select('user', function ($query) use ($user_id) {
        //     $query->where('id', $user_id);
        // })->value('user_id');
        $userId= auth()->user()->id;
        // $userId = $this->belongsTo(User::class,'id');

        // dd($userId);
        $customer = Customer::select('id')->where('user_id', $userId)->first();
        // dd($customer);

        // $customers = $customerRepository->get($request);
        // $customersCount = $customerRepository->count($request);
        $transaction = Transaction::all();
        // $roomstatuses = RoomStatus::all();
        return view('Hotel.rooms', compact('types' , 'rooms' , 'transaction','customer'));
    }



    function roomFiltering(Request $request) {
        // dd(request()->all());
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $checkInDate =$request->input('check_in_date');
        $checkOutDate =$request->input('check_out_date');
        $capacity =$request->input('Capacity');

        // dd($minPrice,$maxPrice, $checkInDate,$checkOutDate,$capacity);

        $roomss = Room::whereBetween('price', [$minPrice, $maxPrice])->get();
        // $roomss = DB::Table('rooms')
        //                     ->whereBetween('price', [$minPrice, $maxPrice])
        //                     ->where('capacity', '<=' , $capacity)->get();
        dd($roomss);
        $availableRooms = DB::table('transactions')
                                    ->whereDate('check_in','<=',$checkInDate)
                                    ->whereDate('check_out','>=',$checkOutDate)->get();
        // dd($availableRooms );
        // return view('Hotel.rooms', ['roomss' => $roomss ,  'transaction' =>$transaction]);
        return view('Hotel.roomFiltered', compact('roomss','availableRooms','checkInDate','checkOutDate','capacity'));
        // return view('Hotel.roomFiltered');
    }

    function singleRoom(Request $request) {
        dd(request()->all());
        $roomType = $request->input('singleRoom');
        $roomImage = $request->input('roomImg');
        // $types = Type::all();
        // dd($roomType,$roomImage);
        // $rooms = Room::all();
        // return view('Hotel.room',compact('types' ,'roomType','rooms','roomImage'));
        // dd($request);
        $selectedItem = $request->query('selected_item');
        return view('Hotel.room')->with('selectedItem', $selectedItem);
    }


    public function search(Request $request)
{
    dd($request);

    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');
    $checkInDate =$request->input('check_in_date');
    $checkOutDate =$request->input('check_out_date');


    $roomss = Room::whereBetween('price', [$minPrice, $maxPrice])->get();
    $availableRooms = DB::table('transactions')
                                ->whereDate('check_in','<=',$checkInDate)
                                ->whereDate('check_out','>=',$checkOutDate)->get();
    // return view('Hotel.rooms', ['roomss' => $roomss ,  'transaction' =>$transaction]);
    return view('Hotel.rooms', compact('roomss','availableRooms','checkInDate','checkOutDate'));
}
    
}
