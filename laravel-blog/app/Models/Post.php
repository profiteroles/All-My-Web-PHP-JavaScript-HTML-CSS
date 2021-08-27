<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $date;
    public $slug;
    public $excerpt;
    public $body;

    public function __construct($title, $date, $slug, $excerpt, $body)
    {
        $this->title = $title;
        $this->date = $date;
        $this->slug = $slug;
        $this->excerpt = $excerpt;
        $this->body = $body;
    }


    public static function find($slug)
    {
        // of all the blog posts, find the one with a slug that matches the one that was requeste
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post =  static::find($slug);
        if (!$post){
            throw new ModelNotFoundException();
        }
        return $post;
    }

    public static function all()
    {
        //sail php artisan tinker -> cache('posts.all') and cache()->forget('posts.all')
        return cache()->remember('posts.all' , now()->second(1), fn() => collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($doc) => new Post(
                $doc->title,
                $doc->date,
                $doc->slug,
                $doc->excerpt,
                $doc->body(),
            ))->sortByDesc('date'));
    }
}
