<?php

namespace Tests\Feature;

use App\Http\Livewire\PostEdit;
use App\Models\Post;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PostEditTest extends TestCase
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
            'title' => 'test title',
            'content' => 'test content',
        ]);
        $response = $this->get(route('posts.edit', $post));
        $response->assertSeeLivewire('post-edit');
    }

    /**
     * @test
     */
    public function test_update_post()
    {
        $post = Post::create([
            'title' => 'test title',
            'content' => 'test content',
        ]);
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'new title')
            ->set('content', 'new content')
            ->call('submitForm')
            ->assertSee('Post updated successfully');
        $post->refresh();
        $this->assertEquals('new title', $post->title);
    }

    /**
     * @test
     */
    public function test_update_image_post()
    {
        $post = Post::create([
            'title' => 'test title',
            'content' => 'test content',
        ]);
        Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('photo.jpg');
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'new title')
            ->set('content', 'new content')
            ->set('photo', $file)
            ->call('submitForm')
            ->assertSee('Post updated successfully');
        $post->refresh();
        $this->assertNotNull($post->photo);
        Storage::disk('public')->assertExists($post->photo);
    }

    /**
     * @test
     */
    public function test_image_not_valid()
    {
        $post = Post::create([
            'title' => 'test title',
            'content' => 'test content',
        ]);
        Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->create('document.pdf',1000);
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'new title')
            ->set('content', 'new content')
            ->set('photo', $file)
            ->call('submitForm')
            ->assertHasErrors(['photo'=>'image']);
        $post->refresh();
        $this->assertNull($post->photo);
//        Storage::disk('public')->assertExists($post->photo);
    }
}
