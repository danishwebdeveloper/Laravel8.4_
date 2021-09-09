<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_PostWhenNoPost()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No Post Yet!');
    
    }

    public function testFactoryComments(){
        
        // Arrange
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(4)->create(
            [
                'blog_post_id' => $post->id,
            ]);

        // Act
            $response = $this->get('/posts');
        
        // Assert
        $response->assertSeeText('Comment on Post: 4');
        
    }

    public function test_Post1BlogPostAtLeastThere()
    {

        // Step 1 Arrange Part
        $blogpost = new BlogPost();
        $blogpost->title = 'New Title';
        $blogpost->content = 'this is a new content';
        $blogpost->save();

        // Step 2 ACT Part
        $response = $this->get('/posts');

        // Step 3 Assert part 
        $response->assertSeeText('No Comment Yet!');
        
    }

    // Get data from BlogPost Model that connected with Db and all time we get fresh data and we test that is it works or not
    private function createDummyBlogPost(): BlogPost 
    {
        $post = new BlogPost();
        $post->title = "New Title";
        $post->content = "A new content is here";
        $post->save();
        return $post;
    }
}
