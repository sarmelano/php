<?php

require_once 'PlantPost.php';
require_once 'NewsPost.php';
require_once 'Post.php';

try {
    $post = new Post('My title', 'My content');
    echo $post->getBody();
} catch (Exception $exception) {

}