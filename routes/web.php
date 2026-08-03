<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\Admin\PublishersController;
use App\Http\Controllers\Admin\BookConditionController;
use App\Http\Controllers\Admin\BookRequestController;

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\RefundsController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SellersController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;

use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\AnalyticsController;

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BackupController;

use App\Http\Controllers\Frontend\HomeController;

use App\Http\Controllers\Auth\AuthController;

    Route::redirect('/', '/frontend');


Route::prefix('admin')
    ->middleware('admin')
    ->name('admin.')
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::controller(AdminController::class)->group(function () {

        Route::get('/dashboard', 'dashboard')->name('dashboard');

        // və ya Laravel standartı:
        // Route::get('/dashboard', 'index')->name('dashboard');

    });


    /*
    |--------------------------------------------------------------------------
    | BOOK MANAGEMENT
    |--------------------------------------------------------------------------
    */

    // Books
    Route::controller(BooksController::class)->prefix('books')->name('books.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{book}', 'show')->name('show');
        Route::get('/{book}/edit', 'edit')->name('edit');
        Route::put('/{book}', 'update')->name('update');
        Route::delete('/{book}', 'destroy')->name('destroy');

    });

    // Book Conditions
    Route::controller(BookConditionController::class)->prefix('book-conditions')->name('book.conditions.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{condition}/edit', 'edit')->name('edit');
            Route::patch('/{condition}/status', 'status')->name('status');
            Route::put('/{condition}', 'update')->name('update');
            Route::delete('/{condition}', 'destroy')->name('destroy');

    });

    // Book Requests
    Route::controller(BookRequestController::class)->prefix('book-requests')->name('book.requests.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{request}/edit', 'edit')->name('edit');
            Route::put('/{request}', 'update')->name('update');
            Route::delete('/{request}', 'destroy')->name('destroy');

    });

    // Categories
    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::patch('/{category}/status', 'toggleStatus')->name('status');
        Route::get('/{category}', 'show')->name('show');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');

    });

    // Authors
    Route::controller(AuthorsController::class)->prefix('authors')->name('authors.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::patch('/{author}/status', 'toggleStatus')->name('status');
        Route::get('/{author}', 'show')->name('show');
        Route::get('/{author}/edit', 'edit')->name('edit');
        Route::put('/{author}', 'update')->name('update');
        Route::delete('/{author}', 'destroy')->name('destroy');

    });

    // Publishers
    Route::controller(PublishersController::class)->prefix('publishers')->name('publishers.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::patch('/{publisher}/status', 'toggleStatus')->name('status');
        Route::get('/{publisher}', 'show')->name('show');
        Route::get('/{publisher}/edit', 'edit')->name('edit');
        Route::put('/{publisher}', 'update')->name('update');
        Route::delete('/{publisher}', 'destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | SALES MANAGEMENT
    |--------------------------------------------------------------------------
    */

    // Refunds
    Route::controller(RefundsController::class)->prefix('refunds')->name('refunds.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{refund}', 'show')->name('show');
        Route::put('/{refund}', 'update')->name('update');

    });

    // Shipping
    Route::controller(ShippingController::class)->prefix('shipping')->name('shipping.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{shipping}/edit', 'edit')->name('edit');
        Route::put('/{shipping}', 'update')->name('update');
        Route::delete('/{shipping}', 'destroy')->name('destroy');

    });

    // Coupons
    Route::controller(CouponsController::class)->prefix('coupons')->name('coupons.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{coupon}/edit', 'edit')->name('edit');
        Route::put('/{coupon}', 'update')->name('update');
        Route::delete('/{coupon}', 'destroy')->name('destroy');

    });

    // Orders
    Route::controller(OrdersController::class)->prefix('orders')->name('orders.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{order}', 'show')->name('show');
        Route::get('/{order}/edit', 'edit')->name('edit');
        Route::put('/{order}', 'update')->name('update');
        Route::delete('/{order}', 'destroy')->name('destroy');

    });

    // Payments
    Route::controller(PaymentsController::class)->prefix('payments')->name('payments.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{payment}/edit', 'edit')->name('edit');
        Route::put('/{payment}', 'update')->name('update');
        Route::delete('/{payment}', 'destroy')->name('destroy');

    });



    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    // Users
    Route::controller(UsersController::class)->prefix('users')->name('users.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}', 'show')->name('show');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');

    });

    // Sellers
    Route::controller(SellersController::class)->prefix('sellers')->name('sellers.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{seller}', 'show')->name('show');
        Route::get('/{seller}/edit', 'edit')->name('edit');
        Route::put('/{seller}', 'update')->name('update');
        Route::delete('/{seller}', 'destroy')->name('destroy');

    });

    // Roles
    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::put('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | CONTENT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    // Reviews
    Route::controller(ReviewsController::class)->prefix('reviews')->name('reviews.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{review}', 'show')->name('show');
        Route::delete('/{review}', 'destroy')->name('destroy');

    });

    // Banners
    Route::controller(BannerController::class)->prefix('banners')->name('banners.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{banner}/edit', 'edit')->name('edit');
        Route::put('/{banner}', 'update')->name('update');
        Route::delete('/{banner}', 'destroy')->name('destroy');

    });

    // Blogs
    Route::controller(BlogController::class)->prefix('blogs')->name('blogs.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{blog}', 'edit')->name('edit');
        Route::put('/{blog}', 'update')->name('update');
        Route::delete('/{blog}', 'destroy')->name('destroy');

    });

    // FAQ
    Route::controller(FaqController::class)->prefix('faq')->name('faq.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{faq}/edit', 'edit')->name('edit');
        Route::put('/{faq}', 'update')->name('update');
        Route::delete('/{faq}', 'destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | ANALYTICS
    |--------------------------------------------------------------------------
    */

    // Reports
    Route::controller(ReportsController::class)->prefix('reports')->name('reports.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/sales', 'sales')->name('sales');
        Route::get('/users', 'users')->name('users');
        Route::get('/books', 'books')->name('books');

    });

    // Analytics
    Route::controller(AnalyticsController::class)->prefix('analytics')->name('analytics.')->group(function () {

        Route::get('/', 'index')->name('index');

    });


    /*
    |--------------------------------------------------------------------------
    | SYSTEM
    |--------------------------------------------------------------------------
    */

    // Settings
    Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');

    });

    // Email Settings
    Route::controller(EmailSettingController::class)->prefix('email-settings')->name('email.settings.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');

    });

    // Notifications
    Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/send', 'send')->name('send');

    });

    // Activity Logs
    Route::controller(ActivityLogController::class)->prefix('activity-logs')->name('activity.logs.')->group(function () {

        Route::get('/', 'index')->name('index');

    });

    // Backup
    Route::controller(BackupController::class)->prefix('backup')->name('backup.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/create', 'create')->name('create');
        Route::get('/download/{file}', 'download')->name('download');

    });

});



/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::prefix('frontend')
    ->name('frontend.')
    ->group(function () {


    // Home
    Route::controller(HomeController::class)->group(function () {

        Route::get('/', 'index')->name('home');

    });



    /*
    |--------------------------------------------------------------------------
    | Authentication (Guest Only)
    |--------------------------------------------------------------------------
    */

    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth.')
        ->middleware('guest')
        ->group(function () {


            Route::get('/login', 'login')
                ->name('login');


            Route::post('/login', 'storeLogin')
                ->name('login.store');



            Route::get('/register', 'register')
                ->name('register');


            Route::post('/register', 'storeRegister')
                ->name('register.store');



            /*
            |--------------------------------------------------------------------------
            | Forgot Password
            |--------------------------------------------------------------------------
            */


            Route::get('/password/request', function () {

                session()->forget('reset_email');

                return view('auth.password-request');

            })->name('password.request');



            /*
            |--------------------------------------------------------------------------
            | OTP Verify
            |--------------------------------------------------------------------------
            */


            Route::get('/password/verify', function () {


                if (!session()->has('reset_email')) {

                    return redirect()
                        ->route('frontend.auth.password.request');

                }


                return view('auth.password-verify');


            })->name('password.verify');



            /*
            |--------------------------------------------------------------------------
            | Send OTP
            |--------------------------------------------------------------------------
            */


            Route::post('/forgot-password/send-otp', 'sendOtp')->name('password.send.otp');



            /*
            |--------------------------------------------------------------------------
            | Verify OTP
            |--------------------------------------------------------------------------
            */


            Route::post('/password/verify', 'verifyOtp')->name('password.verify.otp');            

        });

    /*
    |--------------------------------------------------------------------------
    | Terms (Public - Everyone Can Access)
    |--------------------------------------------------------------------------
    */


    Route::get('/auth/terms', function () {

        return view('auth.terms');

    })->name('auth.terms');





    /*
    |--------------------------------------------------------------------------
    | Authentication (Logged Users Only)
    |--------------------------------------------------------------------------
    */


    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth.')
        ->middleware('auth')
        ->group(function () {


            Route::post('/logout', 'logout')
                ->name('logout');


        });



});


/*
|--------------------------------------------------------------------------
| Profile (Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/my-profile', [AuthController::class, 'myprofile'])->name('my.profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile/photo', [AuthController::class, 'removeProfilePhoto'])->name('profile.photo.destroy');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [AuthController::class, 'destroyProfile'])->name('profile.destroy');

});
