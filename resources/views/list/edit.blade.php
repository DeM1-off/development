@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Одно значения </p><a class="btn btn-outline-success" href="{{ route('home.index' ) }}">назад</a> </div>

                    <form action="{{ route('list.update',$job->id ) }}" method="post">
                        @csrf
                        @method('patch')
                        <label for="title"> Титулка </label>
                        <br>
                        <input type="text" name="title"  value="{{ $job->title }}" >

                        <br>
                        <label for="sum">просто тектс</label>
                        <br>

                        <br>
                        <br>
                        <br>
                        <textarea name="text" id="" cols="30" rows="10"  >{{ $job->text }}</textarea>
                        <br>
                        <br>
                        <label><input type="checkbox" name="show"  @if ($job->show == 1) checked @endif>Показывать это резюме.</label>
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
