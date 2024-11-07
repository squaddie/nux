@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('components.links', ['link' => $link])
            </div>

            <!-- Основное содержимое (пустой контейнер с тремя ссылками) -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        History
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($history as $item)
                                <li class="list-group-item">
                                    {{ $item->status ? 'Win' : 'Lose' }} - {{ $item->sum }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
