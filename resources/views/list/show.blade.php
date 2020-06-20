@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Форма</p>
                        <a class="btn btn-outline-success" href="{{ route('list.index' ) }}">Назад</a></div>
                    <h1>{{ $job->id}} </h1>

                    <p> {{ $job->title}}</p>
                    <p> {{ $job->text}}</p>



                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
