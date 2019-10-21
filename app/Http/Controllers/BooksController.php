<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(){
        $book = Book::create($this->validatedRequest());
        return redirect($book->path());
    }

    public function update(Book $book, Request $request)
    {
        $book->update($this->validatedRequest());

        return redirect($book->path());
    }


   public function destroy(Book $book)
    {
       $book->delete();
       return redirect('/books');
    }
    /**
     * Request validator
     *
     * @return array 
     */
    protected function validatedRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
            ]);
    }
    
}
