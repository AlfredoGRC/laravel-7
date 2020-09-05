<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_post_can_be_retrieved(){

         $this->withoutExceptionHandling();

          $post = factory(Post::class)->create();

          $response = $this->get('/posts/' . $post->id);
  
          $response -> assertOk();
          $post = Post::first();

          $response->assertViewIs('posts.show');
          $response->assertViewHas('post',$post);
     
    }

    public function test_list_of_posts_can_be_retrieved(){

          $this->withoutExceptionHandling();

          factory(Post::class,3)->create();

          $response = $this->get('/posts');

          $response-> assertOk();

          $posts = Post::all();

          $response->assertViewIs('posts.index');
          $response->assertViewHas('posts',$posts);
          
    }

    public function  test_a_post_can_be_created(){

         $this->withoutExceptionHandling();


        $response = $this->post('/posts',[
            'title'=> 'Test Title',
            'content'=> 'Test Content'

        ]) ;

        $this->assertCount(1,Post::all());
 
        $post = Post::first();

        $this->assertEquals($post->title,'Test Title');
        $this->assertEquals($post->content,'Test Content');

        $response->assertRedirect('/posts/' . $post->id);

    }

      public function  test_a_post_can_be_updated(){

        $this->withoutExceptionHandling();

        $post = factory(Post::class)->create();

        $response = $this->put('/posts/' . $post ->id,[
            'title'=> 'Test Title',
            'content'=> 'Test Content'

        ]) ;

        $this->assertCount(1,Post::all());
 
        $post = $post->fresh();

        $this->assertEquals($post->title,'Test Title');
        $this->assertEquals($post->content,'Test Content');

        $response->assertRedirect('/posts/' . $post->id);

    }

    public function  test_a_post_can_be_deleted(){

        $this->withoutExceptionHandling();

        $post = factory(Post::class)->create();

        $response = $this->delete('/posts/' . $post->id) ;

        $this->assertCount(0,Post::all());

        $response->assertRedirect('/posts');

    }


   }

