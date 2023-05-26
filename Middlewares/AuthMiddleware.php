<?php
namespace Middlewares;

class AuthMiddleware {
    public function handle()
    {
        if(!isset($_SESSION['user']))
        {
            return redirect('/login');
        }
    }
}