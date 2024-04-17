@extends('layouts.dashboard')
@section('title', 'Dashboard User')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Create User</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('user.store') }}" method="post" novalidate class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Input User</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the username
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the address
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the phone
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the email
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the password
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Role</label>
                                <select class="form-control" name="role">
                                    <option disabled selected>Select Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label for="">Upload Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-success">Create</button>
                        <a href="{{ route('user') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
