@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Личный кабинет</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="{{ route('home.create') }}" class="btn btn-success create">Добавить резюме</a>


                        <a class="btn btn-info" href="{{ route('list.index' ) }}">Посмотреть все резюме</a></div>
                </div>

                <table class="table">
                    <thead class="table-info">
                    <tr>
                        <th>  id  </th>

                        <th> Титулка  </th>

                        <th> текст  </th>
                        <th>  Показ всем  </th>
                        <th> Узнать больше  </th>
                        <th> Обновить  </th>
                        <th> Удалить  </th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($jobs  as $job)
                        <tr>
                            <td>{{ $job->id }}</td>


                            <td>{{ $job->title }} </td>


                            <td>{{ $job->text }}</td>
                            @if($job->show  == 1)
                            <td class="show">Да</td>
                            @else
                                <td class="show">Нет</td>
                            @endif
                            <td><a class="btn btn-info" href="{{ route('home.show',$job->id ) }}" role="button">

                                        Смотреть</a> </td>
                            <td>   <a class="btn btn-success" href="{{ route('home.edit',$job->id ) }}" role="button">

                                        Изменить</a></td>
                            <form action=" {{route ('home.destroy',$job->id ) }} " method="post">
                                @method('delete')
                                @csrf
                                <td> <button type="submit"  class="btn btn-danger ">X</button>  </td>
                            </form>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
