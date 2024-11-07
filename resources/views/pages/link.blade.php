@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Навигационное меню -->
            <div class="col-md-3">
                @include('components.links', ['link' => $link])
            </div>

            <!-- Основное содержимое (пустой контейнер с тремя ссылками) -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Unique link
                    </div>
                    <div class="card-body">
                        <p>Original Link: <b><i><a href="{{ route('link', ['link' => $link]) }}">{{ $link }}</a></i></b></p>

                        @if(session('newLink'))
                            <p>New Link: <b><i><a href="{{ route('link', ['link' => session('newLink')]) }}">{{ session('newLink') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
