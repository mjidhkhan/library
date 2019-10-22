<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CheckinBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Book $book, Request $request )
    {
        try {
            $book->checkin(auth()->user());
        } catch (\Exception $e) {
            return response([], 404);
        }
        
    }
}
