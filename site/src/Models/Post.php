<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Post extends Model
{
    public int $id;
    public string $title;
    public string $content;
    public string $author;

    public $created_at;
    public $updated_at;

    public function initialize(): void {
        $this->setSource('posts');
    }
}