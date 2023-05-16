<?php

namespace Tests\Feature;

use App\Http\Livewire\CommentsSection;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CommentsSectionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $post = Post::create([
            'title' => 'endooooo',
            'content' => 'sdfsda'
        ]);
        $response = $this->get(route('posts.show', $post));

        $response->assertSeeLivewire('comments-section');
    }

    /**
     * @test
     * */
    public function see_posts_in_home()
    {
        $this->get('/')->assertStatus(200)->
        assertSee('Livewire Blog Posts w/ Comments');
    }

    /**
     * @test
     */
    public function see_valid_comment()
    {
        $post = Post::create([
            'title' => 'endooooo',
            'content' => 'sdfsda'
        ]);
        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->set('comment', 'hello')
            ->call('postComment')
            ->assertSee('Comment was posted!')
            ->assertSee('hello');
    }
    /**
     * @test
     */
    public function see_comment_required()
    {
        $post = Post::create([
            'title' => 'endooooo',
            'content' => 'sdfsda'
        ]);
        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->call('postComment')
            ->assertHasErrors(['comment'=>'required'])
            ->assertSee('The comment field is required.');
    }
    /**
     * @test
     */
    public function see_comment_min()
    {
        $post = Post::create([
            'title' => 'endooooo',
            'content' => 'sdfsda'
        ]);
        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->set('comment','as')
            ->call('postComment')
            ->assertHasErrors(['comment'=>'min'])
            ->assertSee('The comment must be at least 4 characters.');
    }
}
