<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiPostCommentTest extends TestCase
{
    use RefreshDatabase;


    public function testNewBlogPostDoesNotHaveComments()
    {
        // BlogPost::factory()->create([
        //     'user_id' => $this->user()->id
        // ]);
        // Insread of above we declare in TestCase
        $this->blogpost();
        $response = $this->json('GET', 'api/posts/1/comments');
        $response->assertStatus(200);

        $response->assertStatus(200)
        ->assertJsonStructure(['data', 'links', 'meta'])
        ->assertJsonCount(0, 'data');
    }


    public function testBlogPostHas10Comments()
    {
        // BlogPost::factory()->create([
        //     'user_id' => $this->user()->id
        //     ])
            $this->blogpost()->each(function (BlogPost $post) {
                $post->comments()->saveMany(
                   Comment::factory(10)->make([
                        'user_id' => $this->user()->id
                    ])
                );
            });
            $response = $this->json('GET', 'api/posts/2/comments');

            $response->assertStatus(200)
                ->assertJsonStructure(
                    [
                        'data' => [
                            '*' => [
                                'id',
                                'contnt',
                                'created_at',
                                'updated_at',
                                'user' => [
                                    'id',
                                    'name'
                                ]
                            ]
                        ],
                        'links',
                        'meta'
                    ]
                )
                ->assertJsonCount(10, 'data');
                    }
            public function testAddingCommentsWhenNotAuthenticated()
            {
                   $this->blogPost();
                   $response = $this->json('POST', 'api/v1/posts/3/comments', [
                     'content' => 'Hello'
             ]);

                     $response->assertStatus(401);
            }

    public function testAddingCommentsWhenAuthenicated()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user()->id, 'api')->json('POST', 'api/posts/6/comments', [
            'content' => 'Hello'
        ]);

        $response->assertStatus(201);
    }

    public function testAddingCommentWithInvalidData()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user()->id, 'api')->json('POST', 'api/posts/7/comments', []);

        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "content" => [
                        "The content field is required."
                    ]
                ]
            ]);
    }
}
