@extends('layouts.app')


@section('title')
    Login
@endsection


@section('content')
    <div class="row my-3">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">
                        <i class="fas fa-user-plus"></i> Login
                    </h2>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <form action="{{ route('user.auth') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        id="email"
                                        aria-describedby="emailHelpId"
                                        placeholder="Email*"
                                    />
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password*</label>
                                    <input
                                        type="password"
                                        class="form-control  @error('password') is-invalid @enderror"
                                        name="password"
                                        id="password"
                                        placeholder="Password*"
                                    />
                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn btn-dark" type="submit">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection