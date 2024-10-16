<?php

namespace App\Models;

class Post extends BaseModel
{
    protected array $fillable = [
        'title', 'slug', 'content', 'author'
    ];

    public ?int $id = null;
    public string $title = "";

    public string $slug = "";
    public string $content = "";
    public string $author = "";

    public $created_at = null;
    public $updated_at = null;

    public function initialize(): void {
        $this->setSource('posts');
    }
}