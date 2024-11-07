@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Register') }}

                    </div>

                    <div class="card-body">
                        <p>
                            <i>
                                @if(session('disabledLink'))
                                    <p>Your link <b>{{ session('disabledLink') }}</b> are disabled</p>
                                @endif

                                @if(session('expiredLink'))
                                    <p>Your link <b>{{ session('expiredLink') }}</b> are expired</p>
                                @endif
                            </i>
                        </p>
                        <form method="POST" action="{{ route('auth.register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="user_name" class="col-md-4 col-form-label text-md-end">Username</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text"
                                           class="form-control @error('user_name') is-invalid @enderror"
                                           name="user_name" value="{{ old('user_name') }}" required
                                           autocomplete="user_name" autofocus>

                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone
                                    Number</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="tel"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           name="phone_number" value="{{ old('phone_number') }}" required
                                           autocomplete="phone_number">

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
