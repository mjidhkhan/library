<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_library()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Laravel Up & Running',
            'author' => 'Mat Stuffar'
        ]);

        $book = Book::first();
        //$response->assertOk();
        $this->assertCount(1, Book::all());

        $response->assertRedirect($book->path());
        
    }

    /** @test */
    public function a_title_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Mat Stuffar'
        ]);

        $response->assertSessionHasErrors('title');
    }
    
    
    /** @test */
    public function a_author_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Laravel Up & Running',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
   
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Laravel Up & Running',
             'author' => 'Mat Stuffar',
        ]);

        $book= Book::first();
        $response = $this->patch($book->path(),[
            'title' => 'New Title',
             'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);

        // Redirect 
        $response->assertRedirect($book->fresh()->path());
    }
    
    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Laravel Up & Running',
             'author' => 'Mat Stuffar',
        ]);

        $book= Book::first();
        $this->assertCount(1, Book::all());
        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect(('/books'));
    }
    
    

}
