<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Auth; 
use App\Validation\Validator;
use Config\Response;
use App\Models\Post;

class PostController extends Controller {
    public $errors = [];
    public function __construct()
    {
        $this->db = parent::__construct();
    }

    public function index()
    {
        // $ob = new Post();
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }       
    
    public function create()
    {
        return view('posts.create');
    }    
    
    public function store()
    {
        extract($_POST);
        $image_name = null;
        if(!Validator::string($title))
        {
            $this->errors['title'] = 'This field is required!';
        }         
        
        if(!Validator::string($body, 1, 1500))
        {
            $this->errors['body'] = 'Post description must be between 1 and 1500 characters!';
        }          
        
        if(!empty($this->errors))
        {
            return view('posts.create', ['errors'=>$this->errors]);
        }

        $image_name = uploadFile('posts', 'image');

        $created = Post::create([
							'user_id' => Auth::id(),
							'title' => $title,
							'body' => $body,
							'image' => $image_name,
							'published_at' => date('Y-m-d H:i:s'),
						]);

        if($created)
        {
            session('message', 'Your post has been published now!');
            return redirect('/my-post');
        }
    }
    
    public function show()
    {
        $id = $_GET['id'];
        $view_update = Post::updateViewCount($id);
		
        if($view_update)
        {
            $post = Post::findOrFail($id);
        }
        
        return view('posts.show', compact('post'));
    } 
    
    public function edit()
    {

        $id = $_GET['id'];
        $post = $post = Post::findOrFail($id);
		
        if($post && $post['user_id'] == Auth::id())
        {
            return view('posts.edit', compact('post'));
        }
        
        abort(Response::FORBIDDEN);
       
    }    
    
    public function update()
    {
        extract($_POST);
        $post = Post::findOrFail($id);

        if($post && $post['user_id'] == Auth::id())
        {
            if(!Validator::string($title))
            {
                $this->errors['title'] = 'This field is required!';
            }         
            
            if(!Validator::string($body, 1, 1500))
            {
                $this->errors['body'] = 'Post description must be between 1 and 1500 characters!';
            }          
            
            if(!empty($this->errors))
            {

                session('errors', $this->errors);
                return redirect('post-edit?id='.$id);
            }

            destroy('errors');

            $image_name = $post['image'];

            if(!empty($_FILES['image']['name']))
            {
                deleteFile('posts', $image_name);
                $image_name = uploadFile('posts', 'image');
            }

            $updated = Post::update([
							'title' => $title,
							'body' => $body,
							'image' => $image_name,
							'id' => $id,
						]);

            if($updated)
            {
                session('message', 'Your post has been updated now!');
                return redirect('/my-post');
            }
       
        }  
        
        abort(Response::FORBIDDEN);
    }
    
    public function destroy()
    {
        extract($_POST);
        $post = Post::findOrFail($id);
        if($post && $post['user_id'] == Auth::id())
        {
            $deleted = Post::destroy($id);
            if($deleted)
            {
                deleteFile('posts', $post['image']);
                session('message', 'Your post has been deleted now!');
                return redirect('/my-post');
            }
        }

        abort(Response::FORBIDDEN);
    }

    public function myPost()
    {
        $posts = Post::myPost();

        return view('posts.my-post', compact('posts'));
    }  


}