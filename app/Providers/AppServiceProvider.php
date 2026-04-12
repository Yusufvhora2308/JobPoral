<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;

use App\Models\JobNotification;

use Illuminate\Support\Facades\View;

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
      // 🔔 Notifications list
   View::composer('*', function ($view) {

        if (Auth::check()) {

            $notifications = JobNotification::where('user_id', Auth::id())
                ->with('job')
                ->latest()
                ->take(5)
                ->get();

          $notificationCount = JobNotification::where('user_id', Auth::id())
    ->where('is_read', 0)
    ->count();

        } else {
            $notifications = collect(); // important
            $notificationCount = 0;
        }

        $view->with('notifications', $notifications);
        $view->with('notificationCount', $notificationCount);
    });
    }
}
