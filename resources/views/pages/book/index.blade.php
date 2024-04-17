@extends('layouts.dashboard')
@section('title', 'Dashboard Book')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Book</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Book List</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <a href="{{ route('book.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus mr-2"></i>New
                                    Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff')))
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Release Year</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
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
                            </table>
                        </div>
                    @elseif (Auth::check() && Auth::user()->hasRole('borrower'))
                        @foreach ($books as $book)
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/' . $book->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->author }}</p>

                                    <form action="{{ route('borrow.store', $book->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit"
                                            {{ $book->borrows->where('status', 'returned')->isEmpty() ? '' : 'disabled' }}>Borrow</button>
                                    </form>
                                    @foreach ($book->borrows as $borrow)
                                        @if ($borrow->status == 'borrowed')
                                            <form action="{{ route('return.store', $book->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary" type="submit">Return</button>
                                            </form>
                                        @endif
                                    @endforeach
                                    @if ($book->collections->contains('user_id', Auth::user()->id))
                                        <form action="{{ route('collection.delete', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-success">Delete from Collection</button>
                                        </form>
                                    @else
                                        <form action="{{ route('collection.store', $book->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success">Add to Collection</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
