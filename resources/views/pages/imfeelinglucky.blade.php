@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Навигационное меню -->
            <div class="col-md-3">
                @include('components.links', ['link' => $link])
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Imfeelinglucky
                    </div>
                    <div class="card-body">
                        <p>{{ $result->sum ? 'Win' : 'Lose' }} {{ $result->sum }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
