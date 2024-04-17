@extends('layouts.dashboard')
@section('title', 'Dashboard Return Book')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Return Book</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Return Book List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Release Year</th>
                                <th>Category</th>
                                <th>Return By</th>
                                <th>Return Date</th>
                                <th>Action</th>
                            </tr>
                            @if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff')))
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->year }}</td>
                                        <td>
                                            @foreach ($book->categories as $category)
                                                {{ $category->name }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $book->borrows->first()->user->username }}</td>
                                        <td>{{ $book->borrows->first()->return_date }}</td>
                                        <td>
                                            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit">Edit</i></a>
                                            <form action="{{ route('book.delete', $book->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif (Auth::check() && Auth::user()->hasRole('borrower'))
                                @foreach ($bookByUser as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->year }}</td>
                                        <td>
                                            @foreach ($book->categories as $category)
                                                {{ $category->name }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $book->borrows->first()->user->username }}</td>
                                        <td>{{ $book->borrows->first()->return_date }}</td>
                                        <td>
                                            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit">Edit</i></a>
                                            <form action="{{ route('book.delete', $book->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
