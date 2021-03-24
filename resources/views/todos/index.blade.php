<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
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
    <div class="container mt-3">
        <h1 class="text-center">タスク管理アプリ</h1><br>
        @if(Auth::check())
        <!-- ログインしていた場合 -->
        {{ Auth::user()->name }}でログイン中です...................
        @else
        <!-- ログインしていない場合 -->
        ログアウトしています
        @endif
    </div>
    <div class="container mt-3">
        <!-- フォーム -------------------------------------------------------->
        <div class="container mb-4">
            <!-- {!! Form::open(['route' => 'todos.store', 'method' => 'POST']) !!}
            {{ csrf_field() }} -->

            <form action="{{ route('todos.store') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
        
            <input type="text" class="form-control col-5 mr-5" name="newTodo">
            <input type="text" class="form-control col-3 mr-3" id="date-time" placeholder="日時を選択してください" name="newDeadline">
            <input type="submit" class="btn btn-primary" value="新規追加">

                <!-- {{ Form::text('newTodo', null, ['class' => 'form-control col-5 mr-5']) }}
                {{ Form::date('newDeadline', null, ['class' => 'mr-5']) }}
                {{ Form::submit('新規追加', ['class' => 'btn btn-primary']) }} -->
            </div>
            </form>
            <!-- {!! Form::close() !!} -->
        </div>
        <!-- フォーム -------------------------------------------------------->
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
                    <th scope="col" style="width: 40%">やること</th>
                    <th scope="col">期限</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <th scope="row" class="todo">{{ $todo->todo }}</th>
                    <!-- 表示の仕方を変える ->format('Y/m/d H:i') ------nは03→3---------------------------------------->
                    
                    <td class="" value="deadline">{{ $todo->deadline->format('n月j日 G時i分') }}</td>
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
    </div>



    <script>
        
        $(function (){
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



    const todos = @json($todos);
    console.log(todos);
    console.log(todos[1]);

    </script>


</body>
</html>