@extends('layouts.app')

@section('sub-nav-left')
<div class="my-1 mobile-only" style="font-size: 1em;">
    <a href="{{ route('todos.create') }}" class="btn-outline-light p-2"><i class="fas fa-plus-circle"></i></a>
</div>
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="text-center">タスクリスト - 追加</h1>
</div>

<div class="container mt-3">
    <div class="container mb-4">
        <form action="{{ route('todos.store') }}" method="post">
            {{ csrf_field() }}

            <div class="row　justify-content-center mb-3">
                <div class="col-md-8">
                    <label for="newTodo">タスク</label>
                    <input type="text" class="form-control" name="newTodo">
                </div>
            </div>

            @if ($errors->has('newTodo'))
            <p class="alert alert-danger">{{ $errors->first('newTodo') }}</p>
            @endif

            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <label for="newDeadline">Deadline</label>
                    <input type="text" class="form-control" id="date-time" placeholder="日時を選択してください" name="newDeadline">
                </div>
            </div>

            @if ($errors->has('newDeadline'))
            <p class="alert alert-danger">{{ $errors->first('newDeadline') }}</p>
            @endif

            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <input type="submit" class="btn btn-outline-dark" value="新規追加">
                </div>
            </div>

        </form>
    </div>

    <div id="mytest"></div>
</div>
@endsection

@section('extra-js')
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