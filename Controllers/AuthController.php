<?php
require('Controllers/Controller.php');
require('Validation/Validator.php');

use Controllers\Controller;

class AuthController extends Controller{
    public $db;
    public $errors = [];
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function loginView()
    {
        return view('auth.login');
    }    
    
    public function registerView()
    {
        return view('auth.register');
    }        
    
    public function login()
    {
        extract($_POST);

        if(!Validator::string($email))
        {
            $this->errors['email'] = 'This field is required!';
        }          
        
        else if(!Validator::email($email))
        {
            $this->errors['email'] = 'Please enter valid email address!';
        }        
        
        if(!Validator::string($password))
        {
            $this->errors['password'] = 'This field is required!';
        }        

        if(!empty($this->errors))
        {
            return view('auth.login', ['errors'=>$this->errors]);
        }

        if(Auth::attempt($email, $password))
        {
            return redirect('/');
        }

        return view('auth.login', ['error'=> 'Email address or Password is incorrect!']);

        
    }    
    
    public function register()
    {
        extract($_POST);

        if(!Validator::string($name))
        {
            $this->errors['name'] = 'This field is required!';
        }         
        
        if(!Validator::string($email))
        {
            $this->errors['email'] = 'This field is required!';
        }          
        
        else if(!Validator::email($email))
        {
            $this->errors['email'] = 'Please enter valid email address!';
        }                
        
        if(!Validator::string($password))
        {
            $this->errors['password'] = 'This field is required!';
        }        
        
        else if(!Validator::string($password, 4))
        {
            $this->errors['password'] = 'Password must be atleast 4 characters!';
        }
        
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email
        ])->find();

        if($user)
        {
            $this->errors['email'] = 'Email address already exists!';
        }

        if(!empty($this->errors))
        {
            return view('auth.register', ['errors'=>$this->errors]);
        }

        $user = $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)", [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        if($user)
        {
            Auth::login($email, $password);
            return redirect('/');
        }
        
    }    
    
    public function logout()
    {
       Auth::logout();
       return redirect('/');
    }


}