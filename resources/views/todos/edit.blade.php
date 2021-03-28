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

            <!-- </form>     -->
            {!! Form::close() !!}
            <!-- フォーム -------------------------------------------------------->
        </div>


        @if ($errors->has('updateTodo'))
            <p class="alert alert-danger">{{ $errors->first('updateTodo') }}</p>
        @endif
        @if ($errors->has('updateDeadline'))
            <p class="alert alert-danger">{{ $errors->first('updateDeadline') }}</p>
        @endif
    </div>

    @endsection

    @section('extra-js')


    <script>
        $(function () {
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