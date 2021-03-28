
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト - 編集</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/ja.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
</head>

<body>

    <div class="mt-5 px-5">
        <div class="mb-5">
            <div>
                <h1 class="text-center mb-5">既存のタスクを編集</h1>
            </div>

            <form action="{{ route('todos.update', $todo->id) }}" method="post">
                <div>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-lg-6 mx-auto d-block">
                        <label for="" class="mb-4">タスクを編集</label>
                        <input type="text" class="form-control mb-4" name="updateTodo" value="{{ $todo->todo }}">

@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center">タスクリスト - 編集</h1>
    </div>
    <div class="container mt-3">
        <div class="container mb-4">
            <!-- フォーム -------------------------------------------------------->
            {!! Form::open(['route' => ['todos.update', $todo->id], 'method' => 'POST']) !!}

<!-- ここ修正 ----------------------------------------------------------------------------------------------->
            <!-- <form action="{{ route('todos.update', $todo->id) }}" method="post"> -->
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-8">
                            <label for="newTodo">タスク</label>
                            <input type="text" class="form-control" name="newTodo">
                        </div> 
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-8">
                            <label for="newDeadline">Deadline</label>
                            <input type="text" class="form-control" id="date-time" placeholder="日時を選択してください" name="newDeadline">
                        </div>                          
                    </div>      
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-outline-dark" value="Todoリストを更新">
    
                            <!-- {{ Form::text('updateTodo', $todo->todo, ['class' => 'form-control col-7 mr-4']) }}
                            {{ Form::date('updateDeadline', $todo->deadline, ['class' => 'mr-4']) }}
                            {{ Form::submit('Todoリストを更新', ['class' => 'btn btn-primary mr-3']) }} -->
                            <a href="{{ route('todos.index') }}" class="btn btn-outline-dark">戻る</a>        
                        </div>                  

                    </div>

                    @if ($errors->has('updateTodo'))
                    <p class="alert alert-danger col-lg-6 mx-auto d-block">{{ $errors->first('updateTodo') }}</p>
                    @endif

                    <div class="col-lg-6 mx-auto d-block">
                        <label for="" class="mb-4">時刻を編集</label>
                        <input type="text" class="form-control mb-4" id="date-time" placeholder="日時を選択してください" name="updateDeadline" value="{{ $todo->deadline }}">
                    </div>

                    @if ($errors->has('updateDeadline'))
                    <p class="alert alert-danger col-lg-6 mx-auto d-block">{{ $errors->first('updateDeadline') }}</p>
                    @endif


                    <div class="col-lg-6 mx-auto d-block">
                        <label for=""></label>
                        <input type="submit" class="btn btn-primary" value="Todoリストを更新">
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-danger">戻る</a>

    @endsection

    @section('extra-js')


                </div>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            $('#date-time').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                nowButton: true,
                clearButton: true,
                lang: 'ja',
                cancelText: '×',
                okText: '決定',
                clearText: 'クリアー',
                nowText: '現在'
            });
        });
    </script>
@endsection