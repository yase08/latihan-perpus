@extends('layouts.dashboard')
@section('title', 'Dashboard User')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Edit User</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('user.update', $user->id) }}" method="post" novalidate class="needs-validation">
                    @method('PATCH')
                    @csrf
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required
                                    value="{{ $user->username }}">
                                <div class="invalid-feedback">
                                    please fill in the username
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" required
                                    value="{{ $user->address }}">
                                <div class="invalid-feedback">
                                    please fill in the address
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required
                                    value="{{ $user->phone }}">
                                <div class="invalid-feedback">
                                    please fill in the phone
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    value="{{ $user->email }}">
                                <div class="invalid-feedback">
                                    please fill in the email
                                </div>
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label for="">Avatar</label>
                                <img src="{{ asset('images/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail">
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label for="">Upload New Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-success">Update</button>
                        <a href="{{ route('user') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
