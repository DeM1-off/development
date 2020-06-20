@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Создать </p> <a class="btn btn-outline-success" href="{{ route('home.index' ) }}">Назад</a></div>
                    @include('errors')
                    <form action="{{ route('home.store') }}" method="post">
                    @csrf

                    <label for="title"> Титулка </label>
                    <br>
                    <input type="text" name="title"  >

                    <br>
                    <label for="text">Просто текст</label>
                    <br>
                    <br>
                    <textarea name="text" id="" cols="30" rows="10" placeholder="Комментарий"></textarea>
                    <br>
                    <br>
                        <label for="show" >Показать всем пост<br>   <input id="show" type="checkbox" class="btn btn-info" name="show"></label>
                        <br>
                        <br>
                    <button type="submit" class="btn btn-success" value="Click">Click</button>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
