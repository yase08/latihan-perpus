@extends('layouts.dashboard')
@section('title', 'Dashboard Book')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Create Book</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('book.store') }}" method="post" novalidate class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Input Book</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the title
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Author</label>
                                <input type="text" name="author" id="author" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the author
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Publisher</label>
                                <input type="text" name="publisher" id="publisher" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the publisher
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Year</label>
                                <input type="year" name="year" id="year" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the year
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Category</label>
                                <select name="category_id" id="book" class="form-control form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    please fill in the book name
                                </div>
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <button class="btn btn-success">Create</button>
                            <a href="{{ route('book') }}" class="btn btn-danger">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
