<?php
require('Config/Database.php');
$config = require('Config/config.php');
$db = new Database($config['database']);

$posts = $db->query("SELECT p.*, u.name FROM posts p
                        JOIN users u
                        ON p.user_id = u.id
                        ORDER BY p.published_at DESC"
                    )->fetchAll();


require('Views/posts.blade.php');

