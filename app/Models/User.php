<?php
namespace App\Models;
use App\Models\Model;

class User extends Model {

	public $db = "";
	public static $query = "";
	public function __construct()
	{
		$this->db = parent::__construct();
	}
	public function get()
	{
		return "SELECT * FROM users";
	}
	public static function all()
	{
		return "SELECT * FROM users";
	}
	
	public function first()
	{
		return static::$query;
	}
	
	public static function find($id)
	{
		return (new self)->db->query("SELECT * FROM users WHERE id = :id", [
                'id' => $id,
            ])->find();
	}
	
	public static function findOrFail($id)
	{
		return (new self)->db->query("SELECT * FROM users WHERE id = :id", [
                'id' => $id,
            ])->findOrFail();
	}
	
	public static function whereEmail($email)
	{
		static::$query = (new self)->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email
        ])->find();
		
		return new self;
	}
	
	public static function create($data = [])
	{
		return (new self)->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)",$data);
	}
	
	public static function update($data = [])
	{
		return (new self)->db->query("UPDATE users SET name = :name, password = :password, image = :image WHERE id = :id", $data);
	}
	
	public function delete($id)
	{
		
	}
	
}
