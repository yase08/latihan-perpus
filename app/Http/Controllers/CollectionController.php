<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Exception;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function create()
    {
        $existingBookIds = Collection::where('user_id', auth()->user()->id)->pluck('book_id')->toArray();
        $books = Book::whereNotIn('id', $existingBookIds)->get();

        return view('pages.collection.create', compact('books'));
    }

    public function store($id)
    {
        try {
            $collection = Collection::create([
                'book_id' => $id,
                'user_id' => auth()->user()->id,
            ]);

            return redirect('/dashboard/collection')->with('success', 'Collection created successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $collection = Collection::where('book_id', $id)->where('user_id', auth()->user()->id)->first();
        $collection->delete();

        return back()->with('success', 'Collection deleted successfully');
    }
}
