@extends('layouts.dashboard')
@section('title', 'Dashboard Book')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Edit Book</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('book.update', $book->id) }}" method="post" novalidate class="needs-validation">
                    @method('PATCH')
                    @csrf
                    <div class="card-header">
                        <h4>Edit Book</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control" required
                                    value="{{ $book->title }}">
                                <div class="invalid-feedback">
                                    please fill in the title
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Author</label>
                                <input type="text" name="author" id="author" class="form-control" required
                                    value="{{ $book->author }}">
                                <div class="invalid-feedback">
                                    please fill in the author
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Publisher</label>
                                <input type="text" name="publisher" id="publisher" class="form-control" required
                                    value="{{ $book->publisher }}">
                                <div class="invalid-feedback">
                                    please fill in the publisher
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Year</label>
                                <input type="year" name="year" id="year" class="form-control" required
                                    value="{{ $book->year }}">
                                <div class="invalid-feedback">
                                    please fill in the year
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">Update</button>
                        <a href="{{ route('book') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
