<?php
require('Controllers/Controller.php');
require('Validation/Validator.php');

use Controllers\Controller;

class PostController extends Controller {
    public $db;
    public $errors = [];
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $posts = $this->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        ORDER BY p.published_at DESC"
                    )->get();


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

        $created = $this->db->query("INSERT INTO posts (user_id, title, body, image, published_at) VALUES(:user_id, :title, :body, :image, :published_at)", [
            'user_id' => Auth::id(),
            'title' => $title,
            'body' => $body,
            'image' => $image_name,
            'published_at' => date('Y-m-d H:i:s'),
        ]);

        if($created)
        {
            return redirect('/my-post');
        }
    }
    
    public function show()
    {
        $id = $_GET['id'];
        $view_count = $this->db->query("SELECT SUM(view) FROM posts WHERE id = :id", ['id'=>$id])->findOrFail();
        $view_update = $this->db->query("UPDATE posts SET view = $view_count[0] + 1 WHERE id = :id", ['id'=>$id]);
        if($view_update)
        {
            $post = $this->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE p.id = :id
                        ORDER BY p.published_at DESC", ['id'=>$id]
                    )->findOrFail();
        }
        
        return view('posts.show', compact('post'));
    } 
    
    public function edit()
    {

        $id = $_GET['id'];
        $post = $this->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE p.id = :id
                        ORDER BY p.published_at DESC", ['id'=>$id]
                    )->findOrFail();
        if($post && $post['user_id'] == Auth::id())
        {
            return view('posts.edit', compact('post'));
        }
        
        abort(Response::FORBIDDEN);
       
    }    
    
    public function update()
    {
        extract($_POST);
        $post = $this->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE p.id = :id
                        ORDER BY p.published_at DESC", ['id'=>$id]
                    )->findOrFail();

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

                $_SESSION['errors'] = $this->errors;
                return redirect('post-edit?id='.$id);
            }

            unset($_SESSION['errors']);

            $image_name = $post['image'];

            if(!empty($_FILES['image']['name']))
            {
                deleteFile('posts', $image_name);
                $image_name = uploadFile('posts', 'image');
            }

            $updated = $this->db->query("UPDATE posts SET title = :title, body = :body, image = :image WHERE id = :id", [
                'title' => $title,
                'body' => $body,
                'image' => $image_name,
                'id' => $id,
            ]);

            if($updated)
            {
                return redirect('/my-post');
            }
       
        }  
        
        abort(Response::FORBIDDEN);
    }
    
    public function destroy()
    {
        extract($_POST);
        $post = $this->db->query("SELECT *  FROM posts WHERE id = :id", ['id'=>$id])->findOrFail();
        if($post && $post['user_id'] == Auth::id())
        {
            $deleted = $this->db->query("DELETE FROM posts WHERE id = :id", ['id'=>$id]);
            if($deleted)
            {
                deleteFile('posts', $post['image']);
                return redirect('/my-post');
            }
        }

        abort(Response::FORBIDDEN);
    }

    public function myPost()
    {
        $posts = $this->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE user_id = :user_id
                        ORDER BY p.published_at DESC",
                        ['user_id' => Auth::id()]
                    )->get();


        return view('posts.my-post', compact('posts'));
    }  


}