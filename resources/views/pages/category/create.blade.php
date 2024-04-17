@extends('layouts.dashboard')
@section('title', 'Dashboard Category')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Create Category</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('category.store') }}" method="post" novalidate class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Input Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the name
                                </div>
                            </div>
                            <button class="btn btn-success">Create</button>
                            <a href="{{ route('category') }}" class="btn btn-danger">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
