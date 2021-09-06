<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(5)->create();
//        User::truncate();
//        Category::truncate();
//        Post::truncate();
//        $user = User::factory()->create();
//        $personal = Category::create(['name' => 'Personal','slug' => 'personel',]);
//        $family = Category::create(['name' => 'Family','slug' => 'family',]);
//        $work = Category::create(['name' => 'Work','slug' => 'work',]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$personal->id,
//            'title' => 'My Personal Post',
//            'slug'=>    'my-personal-post',
//            'excerpt'=>' Lorem Ipsum dolar Sit amet wtf sit sit ametn.',
//            'body'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec aliquam risus. Vivamus in eleifend est. Praesent ac efficitur lacus. Curabitur placerat vehicula massa quis euismod. Aenean malesuada felis odio, quis auctor justo blandit ut. Maecenas porttitor tortor eget sem ornare porta. Quisque quis sapien ante. In interdum mattis blandit. Vestibulum sem nisl, volutpat non metus sit amet, auctor vehicula leo. Mauris blandit tortor maximus nunc dictum, in sollicitudin metus rhoncus. Nunc ipsum orci, lobortis id magna eget, ultricies ultricies dolor.',
//        ]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$family->id,
//            'title' => 'My Family Post',
//            'slug'=>    'my-family-post',
//            'excerpt'=>' Lorem Ipsum dolar Sit amet wtf sit sit ametn.',
//            'body'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec aliquam risus. Vivamus in eleifend est. Praesent ac efficitur lacus. Curabitur placerat vehicula massa quis euismod. Aenean malesuada felis odio, quis auctor justo blandit ut. Maecenas porttitor tortor eget sem ornare porta. Quisque quis sapien ante. In interdum mattis blandit. Vestibulum sem nisl, volutpat non metus sit amet, auctor vehicula leo. Mauris blandit tortor maximus nunc dictum, in sollicitudin metus rhoncus. Nunc ipsum orci, lobortis id magna eget, ultricies ultricies dolor.',
//        ]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$work->id,
//            'title' => 'My Work Post',
//            'slug'=>    'my-work-post',
//            'excerpt'=>' Lorem Ipsum dolar Sit amet wtf sit sit ametn.',
//            'body'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec aliquam risus. Vivamus in eleifend est. Praesent ac efficitur lacus. Curabitur placerat vehicula massa quis euismod. Aenean malesuada felis odio, quis auctor justo blandit ut. Maecenas porttitor tortor eget sem ornare porta. Quisque quis sapien ante. In interdum mattis blandit. Vestibulum sem nisl, volutpat non metus sit amet, auctor vehicula leo. Mauris blandit tortor maximus nunc dictum, in sollicitudin metus rhoncus. Nunc ipsum orci, lobortis id magna eget, ultricies ultricies dolor.',
//        ]);
    }
}
