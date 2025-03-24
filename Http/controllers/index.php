<?php

use Core\App;
use Core\Database;

$posts_per_page = 6;

$result = App::resolve(Database::class)->query("SELECT account, url, image FROM posts WHERE enabled = 1")->get();
// $result[] = array(
// 	"account" => "animal_liberation_kanagawa",
// 	"url" => "https://www.instagram.com/p/C9yJ4wLyOM5/",
// 	"image" => "insta_C9yJ4wLyOM5.jpg",
// );
shuffle($result);
$posts = array_slice($result, 0, $posts_per_page);

view('index.view.php', [
	'meta_title' => __('home.page_title'),
	'meta_description' => __('home.page_description'),
	'posts' => $posts,
]);