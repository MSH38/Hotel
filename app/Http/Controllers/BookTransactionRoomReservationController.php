<?php

namespace App\Http\Controllers;
use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\CustomerRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\TransactionRepository;

use Illuminate\Http\Request;

class BookTransactionRoomReservationController extends Controller
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function pickFromCustomer(Request $request, CustomerRepository $customerRepository)
    {
        $customers = $customerRepository->get($request);
        $customersCount = $customerRepository->count($request);
        return view('Hotel.Booking.reservation.pickFromCustomer', compact('customers', 'customersCount'));
    }

    public function createIdentity()
    {
        // dd('blaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        // StoreCustomerRequest $request, CustomerRepository $customerRepository
        // $request=>StoreCustomerRequest::$request;
        // $customer = CustomerRepository()->$customerRepository;
        // $customer = $customerRepository;
        // if ($customer) {
        //     // The email exists in the customers table, retrieve its data and go to the next page
        //     return redirect()->route('Hotel.Booking.reservation.viewCountPerson', ['customer' => $customer->id])->with( 'Welcome Again ' . $customer->name );
        // } else {
        //     // The email doesn't exist in the customers table, go to the form page
        //     return view('Hotel.Booking.reservation.createIdentity');
        // }
        return view('Hotel.Booking.reservation.createIdentity');

    }

    public function storeCustomer(StoreCustomerRequest $request, CustomerRepository $customerRepository)
    {
        // $request->validate([
        //     'name' => ['string', 'max:255', 'default:' . auth()->user()->name],
        //     'email' => ['string', 'max:255', 'default:' . auth()->user()->email]
        //     // other validation rules for your form fields...
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email|unique:users,email',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
        // $customer = new Customer;
        // $customer->user_id = auth()->user()->id;
        // $customer->email = $request->input('email');
        // $customer->save();
        if ($customer) {
            // The email exists in the customers table, retrieve its data and go to the next page
            return redirect()->route('Hotel.Booking.reservation.viewCountPerson', ['customer' => $customer->id])->with( 'Welcome Again ' . $customer->name );
        } else {
            // The email doesn't exist in the customers table, go to the form page
            $customer = $customerRepository->store($request);
            return redirect()->route('Hotel.Booking.reservation.viewCountPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
        }
    //     $customer = $customerRepository->store($request);
    //     return redirect()->route('Hotel.Booking.reservation.viewCountPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }
    function bla() {
        dd('blalalallaal');
    }

    public function viewCountPerson(Customer $customer)
    {   
        return view('Hotel.Booking.reservation.viewCountPerson', compact('customer'));
    }

    public function choosesRoom( ChooseRoomRequest $request, Customer $customer)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;
        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);
        return view('Hotel.Booking.reservation.chooseRoom', compact('customer', 'rooms', 'stayFrom', 'stayUntil', 'roomsCount'));
    }

    public function confirmation(Customer $customer, Room $room, $stayFrom, $stayUntil)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;
        return view('Hotel.Booking.reservation.confirmation', compact('customer', 'room', 'stayFrom', 'stayUntil', 'downPayment', 'dayDifference'));
    }

    public function payDownPayment(Customer $customer, Room $room, Request $request, TransactionRepository $transactionRepository, PaymentRepository $paymentRepository)
    {
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;

        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        $transaction = $transactionRepository->store($request, $customer, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);

        $superAdmins = User::where('role', 'Super')->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $customer->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }

        event(new RefreshDashboardEvent("Someone reserved a room"));

        return redirect()->route('Hotel.Booking.index')->with('success', 'Room ' . $room->number . ' has been reservated by ' . $customer->name);
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        $occupiedRoomId = Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
        return $occupiedRoomId;
    }
}

