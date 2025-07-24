@extends('layouts.app')

@section('title')
   Plans
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-md-4">
                        <div class="card {{ session()->has('chosenPlan') && $plan->id == session()->get('chosenPlan')->id ? 'border border-danger border-2' : '' }} text-center mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">
                                    {{ $plan->name }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title">
                                    ${{ $plan->price }} <small class="text-body-secondary fw-light">/mo</small>
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <span class="fw-bold">
                                            {{ $plan->number_of_qrcodes }}
                                        </span>
                                        <i class="fas fa-qrcode"></i>
                                    </li>
                                </ul>
                                <a href="{{ route('subscription.show',$plan->id) }}" class="w-100 btn btn-outline-primary">
                                    Choose plan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @session('chosenPlan')
                @include('subscriptions.subscribe')
            @endsession
        </div>
    </div>
@endsection