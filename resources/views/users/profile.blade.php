@extends('layouts.app')

@section('title')
   Profile
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">
                        <i class="fas fa-user"></i> Profile
                    </h2>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item border border-2 border-dark text-center mb-2">
                                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                </li>
                                <li class="list-group-item border border-2 border-dark text-center mb-2">
                                    <i class="fas fa-envelope"></i> {{ auth()->user()->email }}
                                </li>
                                <li class="list-group-item border border-2 border-dark text-center mb-2">
                                    <i class="fas fa-qrcode"></i> {{ auth()->user()->number_of_qrcodes }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            @foreach (auth()->user()->subscriptions as $subscription)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-bold">Subscribed to plan:</span>
                                    <span class="text-dark fw-bold">
                                        {{ $subscription->plan->name }}
                                    </span>
                                    <span class="text-danger me-2">
                                        ${{ $subscription->plan->price }}/Month
                                    </span>
                                    <form action="{{ route('subscription.cancel') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="stripe_subscription_id"
                                            value="{{ $subscription->stripe_subscription_id }}"
                                        >
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection