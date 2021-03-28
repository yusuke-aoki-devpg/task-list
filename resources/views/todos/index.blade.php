@extends('layouts.app')

@section('sub-nav-left')
<div class="my-1 mobile-only" style="font-size: 1em;">
    <a href="#" class="btn-outline-light p-2"><i class="fas fa-plus-circle"></i> </a>   
</div>
@endsection

@section('content')
    <div class="container mt-3">
        <!-- フォーム -------------------------------------------------------->
        <div class="container mb-4 pc-only">
            <!-- {!! Form::open(['route' => 'todos.store', 'method' => 'POST']) !!}
            {{ csrf_field() }} -->

            <form action="{{ route('todos.store') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
        
            <input type="text" class="form-control col-5 mr-5" name="newTodo">
            <input type="text" class="form-control col-3 mr-3" id="date-time" placeholder="日時を選択してください" name="newDeadline">
            <input type="submit" class="btn btn-outline-dark" value="新規追加">

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
                    <th scope="col" style="width: 50%">やること</th>
                    <th scope="col" class="pc-only">期限</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <td class="todo pc-only">{{ $todo->todo }}</td>
                    <!-- 表示の仕方を変える ->format('Y/m/d H:i') ------nは03→3---------------------------------------->
                    <td class="pc-only" value="deadline">{{ $todo->deadline->format('n月d日 H:i') }}</td>

                    <td class="mobile-only">
                        <span>{{ $todo->todo }}</span>
                        <br >
                        <small value="deadline">{{ $todo->deadline->format('n月d日 H:i') }}</small>
                    </td>

                    <td><a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-outline-dark">編集</a></td>
                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}</td>
                    {!! Form::close() !!}
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="mytest"></div>
    </div>
    @endsection

    @section('extra-js')
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
@endsection