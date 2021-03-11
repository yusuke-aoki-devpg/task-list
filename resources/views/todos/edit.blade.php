<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト - 編集</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <h1>Todoリスト - 編集</h1>
    </div>
    <div class="container mt-3">
        <div class="container mb-4">
            {!! Form::open(['route' => ['todos.update', $todo->id], 'method' => 'POST']) !!}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                <div class="row">
                    {{ Form::text('updateTodo', $todo->todo, ['class' => 'form-control col-7 mr-4']) }}
                    {{ Form::date('updateDeadline', $todo->deadline, ['class' => 'mr-4']) }}
                    {{ Form::submit('Todoリストを更新', ['class' => 'btn btn-primary mr-3']) }}
                    <a href="{{ route('todos.index') }}" class="btn btn-danger">戻る</a>
                </div>
            {!! Form::close() !!}
        </div>
        @if ($errors->has('updateTodo'))
            <p class="alert alert-danger">{{ $errors->first('updateTodo') }}</p>
        @endif
        @if ($errors->has('updateDeadline'))
            <p class="alert alert-danger">{{ $errors->first('updateDeadline') }}</p>
        @endif
    </div>
</body>
</html>