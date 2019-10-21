<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(){
        Book::create($this->validatedRequest());
    }

    public function update(Book $book)
    {
        $book->update($this->validatedRequest());
    }


    /**
     * Request validator
     *
     * @return validated response
     */
    protected function validatedRequest()
    {
        return request()->validate(['title' => 'required','author' => 'required']);
    }
    
}
