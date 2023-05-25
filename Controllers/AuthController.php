<?php
require base_path('Controllers/Controller.php');
require base_path('Validation/Validator.php');

// use Controllers\Controller;

class AuthController extends Controller{
    public $errors = [];
    public function __construct()
    {
        $this->db = parent::__construct();
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

    public function myProfile()
    {
        return view('auth.profile');
    }    
    
    public function updateProfile()
    {
        extract($_POST);

        if(!Validator::string($name))
        {
            $this->errors['name'] = 'This field is required!';
        }         
        
        if(!empty($old_password))         
        {
            if(!password_verify($old_password, Auth::password()))
            {
                $this->errors['old_password'] = 'Old password does not match!';
            }

            if(!Validator::string($new_password))
            {
                $this->errors['new_password'] = 'This field is required!';
            }            
            
            else if(!Validator::string($new_password, 4))
            {
                $this->errors['new_password'] = 'Password must be atleast 4 characters!';
            }
        }
        if(!empty($this->errors))
        {

            $_SESSION['errors'] = $this->errors;
            return redirect('/my-profile');
        }

        unset($_SESSION['errors']);

        $image_name = Auth::image();
        $password = Auth::password();

        if(!empty($_FILES['image']['name']))
        {
            deleteFile('users', $image_name);
            $image_name = uploadFile('users', 'image');
        }

        if(!empty($new_password))
        {
            $password = password_hash($new_password, PASSWORD_DEFAULT);
        }

        $updated = $this->db->query("UPDATE users SET name = :name, password = :password, image = :image WHERE id = :id", [
            'name' => $name,
            'password' => $password,
            'image' => $image_name,
            'id' => Auth::id(),
        ]);

        if($updated)
        {
            $user = $this->db->query("SELECT * FROM users WHERE id = :id", [
                'id' => Auth::id(),
            ])->find();

            $_SESSION['user'] = $user;

            session('message', 'Your profile has been updated successfully!');

            return redirect('/my-profile');
        }
        
    }


}