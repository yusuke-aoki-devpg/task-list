@extends('layouts.subnav')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="m-5 col-11 col-md-6">
    
            <div class="py-4 bg-info">
                <h4 class="text-center">タスクリスト 追加</h4>
            </div>
    
            <div class="py-4 bg-light">
                <div class="container mb-4">
                    <form action="{{ route('todos.store') }}" method="post">
                        {{ csrf_field() }}
    
                        <div class="row mb-3">
                            <div class="col">
                                <label for="newTodo">タスク</label>
                                <input type="text" class="form-control" name="newTodo">
                            </div>
                        </div>
    
                        @if ($errors->has('newTodo'))
                        <p class="alert alert-danger">{{ $errors->first('newTodo') }}</p>
                        @endif
    
                        <div class="row mb-3">
                            <div class="col">
                                <label for="newDeadline">Deadline</label>
                                <input type="text" class="form-control" id="date-time" placeholder="日時を選択してください" name="newDeadline">
                            </div>
                        </div>
    
                        @if ($errors->has('newDeadline'))
                        <p class="alert alert-danger">{{ $errors->first('newDeadline') }}</p>
                        @endif
    
                        <div class="row mb-3">
                            <div class="col">
                                <input type="submit" class="btn btn-outline-dark" value="新規追加">
                                <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">戻る</a>        
                            </div>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

