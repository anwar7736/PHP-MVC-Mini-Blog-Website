<?php
require('Controllers/Controller.php');

use Controllers\Controller;

class PostController extends Controller {
    public $db;
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
        
    }    
    
    public function store()
    {
       dd($_POST);
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
        
       
    }    
    
    public function update()
    {
        
       
    }    
    
    public function destroy()
    {
        
       
    }


}