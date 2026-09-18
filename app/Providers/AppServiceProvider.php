<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layout.admin.master', function ($view) {

            $unreadMessagesCount = Message::where(
                'status',
                'unread'
            )->count();

            $view->with(
                'unreadMessagesCount',
                $unreadMessagesCount
            );
        });
    }
}