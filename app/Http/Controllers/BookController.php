<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        // $bookByUser = Book::with('borrows')->whereHas('borrows', function ($query) {
        //     $query->where('user_id', auth()->user()->id);
        // })->latest()->get();

        return view('pages.book.index', compact('books'));
    }

    public function return()
    {
        $bookByUser = Book::whereHas('borrows', function ($query) {
            $query->where('user_id', auth()->user()->id)->where('status', 'returned');
        })->get();
        $books = Book::whereHas('borrows', function ($query) {
            $query->where('status', 'returned');
        })->with('borrows')->get();

        return view('pages.return_book.index', compact('bookByUser', 'books'));
    }

    public function returnStore($id)
    {
        $borrow = Borrow::where('book_id', $id)->where('status', 'borrowed')->firstOrFail();

        $borrow->update([
            'return_date' => date('Y-m-d'),
            'status' => 'returned'
        ]);

        return back()->with('success', 'Book returned successfully');
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.book.create', compact('categories'));
    }

    public function borrow($id)
    {
        Borrow::create([
            'user_id' => auth()->user()->id,
            'book_id' => $id,
            'status' => 'borrowed',
            'borrow_date' => date('Y-m-d'),
            'return_date' =>  null
        ]);

        return back()->with('success', 'Book borrowed successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'category_id' => 'required'

        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'image' => $imageName
        ]);

        $book->categories()->attach($request->category_id);

        return redirect('/dashboard/book')->with('success', 'Book created successfully');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('pages.book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'category_id' => 'required'
        ]);

        if ($request->category_id == null) {
            return back()->with('error', 'Please select at least one category');
        }

        $book = Book::find($id);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
        ]);

        $book->book_categories()->sync($request->category_id);

        return redirect('/dashboard/book')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return back()->with('success', 'Book deleted successfully');
    }
}
