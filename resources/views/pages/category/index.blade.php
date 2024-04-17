@extends('layouts.dashboard')
@section('title', 'Dashboard Category')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Category</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category List</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <a href="{{ route('category.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus mr-2"></i>New
                                    Category</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit">Edit</i></a>
                                        <form action="{{ route('category.delete', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i>Delete</button>
                                    </td>
                            @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
