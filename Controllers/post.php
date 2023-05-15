<?php
require('Config/Database.php');
$config = require('Config/config.php');
$db = new Database($config['database']);

$id = $_GET['id'];
$view_count = $db->query("SELECT SUM(view) FROM posts WHERE id = $id")->fetch();
$view_update = $db->query("UPDATE posts SET view = $view_count[0] + 1 WHERE id = $id");
if($view_update)
{
    $post = $db->query("SELECT p.*, u.name FROM posts p
                JOIN users u
                ON p.user_id = u.id
                WHERE p.id = $id
                ORDER BY p.published_at DESC"
            )->fetch();
}

require('Views/post.blade.php');

