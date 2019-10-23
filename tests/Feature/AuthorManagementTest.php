<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



class AuthorManagementTest extends TestCase
{
     use RefreshDatabase;
    /** @test */
    public function an_author_can_be_created()
    {
       
        //$this->withoutExceptionHandling();
        $this->post('/authors', $this->data());

        $author = Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }

    private function data()
    {
        return [
            'name' => 'Authon Name',
            'dob'   =>'05/14/1988'
        ];
    }

    
    
    
}
