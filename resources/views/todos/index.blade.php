<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>タスク管理アプリ</h1><br>
        @if(Auth::check())
        <!-- ログインしていた場合 -->
        {{ Auth::user()->name }}でログイン中です...................
        @else
        <!-- ログインしていない場合 -->
        ログアウトしています
        @endif
    </div>
    <div class="container mt-3">
        <div class="container mb-4">
            {!! Form::open(['route' => 'todos.store', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            <div class="row">
                {{ Form::text('newTodo', null, ['class' => 'form-control col-5 mr-5']) }}
                {{ Form::date('newDeadline', null, ['class' => 'mr-5']) }}
                <!-- {{ Form::time('newDeadline', null, ['class' => 'mr-5']) }} -->
                {{ Form::submit('新規追加', ['class' => 'btn btn-primary']) }}
            </div>
            {!! Form::close() !!}
        </div>
        {{-- エラー表示 ここから --}}
        @if ($errors->has('newTodo'))
        <p class="alert alert-danger">{{ $errors->first('newTodo') }}</p>
        @endif
        @if ($errors->has('newDeadline'))
        <p class="alert alert-danger">{{ $errors->first('newDeadline') }}</p>
        @endif
        {{-- エラー表示 ここまで --}}

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 40%">Todo</th>
                    <th scope="col">期限</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <th scope="row" class="todo">{{ $todo->todo }}</th>
                    <td>{{ $todo->deadline }}</td>
                    <td><a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary">編集</a></td>
                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-danger']) }}</td>
                    {!! Form::close() !!}
                </tr>
                @endforeach
            </tbody>
        </table>

        
        <a href="{{ url('/home') }}" class="btn btn-primary">ホーム画面へ</a>
        <input type="datetime-local">
    </div>
</body>

</html>