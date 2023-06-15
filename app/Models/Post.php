<?php
namespace App\Models;
use App\Http\Controllers\Auth\Auth;
use App\Models\Model;

class Post extends Model {
	
	public $db = "";
	public function __construct()
	{
		$this->db = parent::__construct();

	}
	public function get()
	{
		return (new self)->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        ORDER BY p.published_at DESC"
                    )->get();
	}
	public static function all()
	{
		 
		return (new self)->db->query("SELECT p.*, u.name FROM posts p
				JOIN users u
				ON p.user_id = u.id
				ORDER BY p.published_at DESC"
			)->get();
	}
	
	public function first()
	{
		
	}
	
	public static function find($id)
	{
		return (new self)->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE p.id = :id
                        ORDER BY p.published_at DESC", ['id'=>$id]
                    )->find();
	}
	
	public static function findOrFail($id)
	{
		return (new self)->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE p.id = :id
                        ORDER BY p.published_at DESC", ['id'=>$id]
                    )->findOrFail();
	}
	public static function updateViewCount($id)
	{
		$view_count = (new self)->db->query("SELECT SUM(view) FROM posts WHERE id = :id", ['id'=>$id])->findOrFail();
		
		return (new self)->db->query("UPDATE posts SET view = $view_count[0] + 1 WHERE id = :id", ['id'=>$id]);
	}
	
	public static function myPost()
	{
		return (new self)->db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        WHERE user_id = :user_id
                        ORDER BY p.published_at DESC",
                        ['user_id' => Auth::id()]
                    )->get();
	}
	
	public static function create($data = [])
	{
		return (new self)->db->query("INSERT INTO posts (user_id, title, body, image, published_at) VALUES(:user_id, :title, :body, :image, :published_at)", $data);
	}
	
	public static function update($data = [])
	{
		return (new self)->db->query("UPDATE posts SET title = :title, body = :body, image = :image WHERE id = :id", $data);
	}
	
	public function destroy($id)
	{
		return (new self)->db->query("DELETE FROM posts WHERE id = :id", ['id'=>$id]);
	}
	
}
