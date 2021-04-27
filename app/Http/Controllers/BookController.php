<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Publisher;
use Validator;
use PDF;

class BookController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //FILTRAVIMAS
        $authors = Author::all();

        if($request->author_id) {
            $books = Book::where('author_id',$request->author_id) ->get();
            $filterBy = $request->author_id;
        }
        else {
            // $books = Book::all();
            $books =Book::orderBy('title')->get();

        }

        // Rusiavimas SORT
        if($request->sort && 'asc' == $request->sort) {
            $books = $books ->sortBy('title');
            $sortBy = 'asc';
        }
        elseif($request->sort && 'desc' == $request->sort) {
            $books = $books ->sortByDesc('title');
            $sortBy = 'desc';
        }

    return view('book.index', [
        'books' => $books, 
        'authors' => $authors,
        'filterBy'=>$filterBy ?? 0,
        'sortBy' => $sortBy ?? ''
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('book.create', ['authors' => $authors, 'publishers'=> $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
             [
           'book_title' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:255'],
           'book_pages' => ['required', 'numeric', 'min:1','max:2000'],
           'book_isbn' => ['required', 'min:3', 'max:64'],
           'book_short_description' => ['required', 'min:3', 'max:1000'],
            ],
            [
            
            ]
       );
       if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }

        $book = new Book;
       $book->title = $request->book_title;
       $book->pages = $request->book_pages;
       $book->isbn = $request->book_isbn;
       $book->short_description = $request->book_short_description;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Book created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make(
            $request->all(),
             [
           'book_title' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:255'],
           'book_pages' => ['required', 'numeric', 'min:1','max:2000'],
           'book_isbn' => ['required', 'min:3', 'max:64'],
           'book_short_description' => ['required', 'min:3', 'max:1000'],
            ],
            [
            
            ]
       );
       if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }

        
       $book->title = $request->book_title;
       $book->pages = $request->book_pages;
       $book->isbn = $request->book_isbn;
       $book->short_description = $request->book_short_description;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success_message', 'Book deleted.');
    }

    public function pdf(Book $book)
    {
        $pdf = PDF::loadView('book.pdf', ['book'=>$book]); // standartinis view
        return $pdf->download('book-id'.$book ->id.'.pdf'); // pdf failo pavadinimas.
    }
}
