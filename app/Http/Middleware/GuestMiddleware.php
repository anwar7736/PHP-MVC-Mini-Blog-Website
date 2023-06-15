<?php
namespace App\Http\Middleware;

class GuestMiddleware {
    public function handle()
    {
        if(isset($_SESSION['user']))
        {
            return redirect('/');
        }
    }
}