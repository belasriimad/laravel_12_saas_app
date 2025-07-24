@extends('layouts.app')

@section('title')
   Login
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <h3 class="mt-2">
                        <i class="fas fa-sign-in"></i> Login
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <form action="{{ route('user.auth') }}" 
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        id="email"
                                        placeholder="Email*"
                                    />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password*</label>
                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        id="password"
                                        placeholder="Password*"
                                    />
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-sm btn-dark">
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