@extends('layouts.app')

@section('title')
   Create a Qrcode
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <h3 class="mt-2">
                        Add new Qrcode
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <form action="{{ route('qrcodes.store') }}" 
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">
                                        Content*
                                    </label>
                                    <textarea 
                                        class="form-control @error('content') is-invalid @enderror" 
                                        name="content" 
                                        id="content" 
                                        rows="3"  
                                        placeholder="Content*"
                                    >{{ old('content') }}</textarea>
                                    @error('content')
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