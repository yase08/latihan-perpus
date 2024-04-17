@extends('layouts.dashboard')
@section('title', 'Dashboard User')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>User</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User List</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <a href="{{ route('user.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus mr-2"></i>New
                                    User</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $user)
                                @php
                                    $role = $user->hasRole('admin') ? 'Admin' : 'User';
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $role }}</td>
                                    @if ($user->last_login == null)
                                        <td>-</td>
                                    @else
                                        <td>{{ date('Y-m-d H:i:s', strtotime($user->last_login)) }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit">Edit</i></a>
                                        <form action="{{ route('user.delete', $user->id) }}" method="POST"
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
