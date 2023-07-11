<?php


use App\Models\User;
use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionRoomReservationController;
use App\Http\Controllers\BookTransactionRoomReservationController;

use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('Hotel.home');
// });


Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/dashboard',[DashboardController::class, 'index']
)->middleware(['auth', 'checkRole:Super,Admin'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['auth', 'checkRole:Super']], function () {
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    
    Route::post('/room/{room}/image/upload', [ImageController::class, 'store'])->name('image.store');
    Route::delete('/image/{image}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::name('transaction.reservation.')->group(function () {
        Route::get('/createIdentity', [TransactionRoomReservationController::class, 'createIdentity'])->name('createIdentity');
        Route::get('/pickFromCustomer', [TransactionRoomReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
        Route::post('/storeCustomer', [TransactionRoomReservationController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('/{customer}/viewCountPerson', [TransactionRoomReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
        Route::get('/{customer}/chooseRoom', [TransactionRoomReservationController::class, 'chooseRoom'])->name('chooseRoom');
        Route::get('/{customer}/{room}/{from}/{to}/confirmation', [TransactionRoomReservationController::class, 'confirmation'])->name('confirmation');
        Route::post('/{customer}/{room}/payDownPayment', [TransactionRoomReservationController::class, 'payDownPayment'])->name('payDownPayment');
    });

    Route::resource('customer', CustomerController::class);
    Route::resource('type', TypeController::class);
    Route::resource('room', RoomController::class);
    Route::resource('roomstatus', RoomStatusController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('facility', FacilityController::class);

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');

    Route::get('/transaction/{transaction}/payment/create', [PaymentController::class, 'create'])->name('transaction.payment.create');
    Route::post('/transaction/{transaction}/payment/store', [PaymentController::class, 'store'])->name('transaction.payment.store');

    Route::get('/get-dialy-guest-chart-data', [ChartController::class, 'dialyGuestPerMonth']);
    Route::get('/get-dialy-guest/{year}/{month}/{day}', [ChartController::class, 'dialyGuest'])->name('chart.dialyGuest');
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    // Route::resource('user', UserController::class)->only([
    //     'show'
    // ]);
    Route::view('/notification', 'notification.index')->name('notification.index');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mark-all-as-read', [NotificationsController::class, 'markAllAsRead'])->name('notification.markAllAsRead');
    Route::get('/notification-to/{id}',[NotificationsController::class, 'routeTo'])->name('notification.routeTo');
});

Route::group(['middleware' => ['auth', 'checkRole:Customer']], function () {
    Route::name('book.reservation.')->group(function () {
        Route::get('/CreateIdentity', [BookTransactionRoomReservationController::class, 'createIdentity'])->name('CustomerCreateIdentity');
        Route::get('/PickFromCustomer', [BookTransactionRoomReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
        Route::post('/StoreCustomer', [BookTransactionRoomReservationController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('/{customer}/ViewCountPerson', [BookTransactionRoomReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
        Route::get('/{customer}/ChooseRoom', [BookTransactionRoomReservationController::class, 'chooseRoom'])->name('chooseRoom');
        Route::get('/{customer}/{room}/{from}/{to}/Confirmation', [BookTransactionRoomReservationController::class, 'confirmation'])->name('confirmation');
        Route::post('/{customer}/{room}/PayDownPayment', [BookTransactionRoomReservationController::class, 'payDownPayment'])->name('payDownPayment');
    });
    // Route::resource('/booking', BookController::class);
});



Route::get('/home', [HomeController::class, 'index']);

Route::get('/sendEvent', function () {
    $superAdmins = User::where('role', 'Super')->get();
    event(new RefreshDashboardEvent("Someone reserved a room"));

    foreach ($superAdmins as $superAdmin) {
        $message = 'Reservation added by';
        // event(new NewReservationEvent($message, $superAdmin));
    }
});
// Route::get('/home',[UserController::class,'home']);
Route::get('/about-us',[UserController::class,'about']);
Route::get('/contact',[ContactController::class,'createForm'])->name('contact.show');
Route::post('/contact',[ContactController::class,'ContactUsForm'])->name('contact.submit');
// Route::get('/contact', [ContactUsFormController::class, 'createForm']);
// Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');

Route::get('/rooms',[RoomController::class,'displayRooms']);
// Route::get('/roomBooking',[RoomController::class,'singleRoom'])->middleware(['auth', 'verified'])->name('roomBooking');

Route::get('/roomBooking/{roomBooking}',[RoomController::class,'singleRoom'])->middleware(['auth', 'verified'])->name('roomBooking');
// Route::get('/roomFiltering',[RoomController::class,'roomFiltering'])->name('roomFiltering');
Route::get('/restaurant',[UserController::class,'restaurant']);
Route::get('/search', [RoomController::class,'roomFiltering'])->name('roomFiltering');


require __DIR__.'/auth.php';


// Route::get('/room-reservation', function () {
//     return view('room-reservation');
// })->middleware(['auth', 'verified'])->name('room-reservation');