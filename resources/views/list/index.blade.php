@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список пользователей</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <a class="btn btn-info" href="{{ route('home.index' ) }}">Зайти в свой кабинет</a></div>
                    </div>

                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th>  id  </th>

                            <th> Тиутлка  </th>

                            <th> Текст </th>

                            <th> Узнать больше  </th>
                            @if($role == 0)

                            @else
                            <th> Обновить  </th>
                            <th> Удалить  </th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($jobs  as $job)
                            <tr>
                                <td>{{ $job->id }}</td>

                                <td>{{ $job->title }} </td>


                                <td>{{ $job->text }}</td>
                                <td><a class="btn btn-info" href="{{ route('list.show',$job->id ) }}" role="button">

                                        Показать</a> </td>
                                @if($role == 0)

                                @else



                                <td>   <a class="btn btn-success" href="{{ route('list.edit',$job->id ) }}" role="button">

                                        Изменить</a></td>
                                <form action=" {{route ('list.destroy',$job->id ) }} " method="post">
                                    @method('delete')
                                    @csrf
                                    <td> <button type="submit"  class="btn btn-danger ">X</button>  </td>
                                </form>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
