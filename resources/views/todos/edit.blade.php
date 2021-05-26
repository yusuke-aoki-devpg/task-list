@extends('layouts.subnav')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="m-5 col-11 col-md-6">
    
            <div class="py-4 bg-info">
                <h4 class="text-center">タスクリスト 編集</h4>
            </div>
    
            <div class="py-4 bg-light">
                <div class="container mb-4">
                    <form action="{{ route('todos.update', $todo->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="updateTodo">タスク</label>
                                    <input type="text" class="form-control" name="updateTodo" value="{{ $todo->todo }}">
                                </div> 
                            </div>
    
                            @if ($errors->has('updateTodo'))
                            <p class="alert alert-danger">{{ $errors->first('updateTodo') }}</p>
                            @endif
    
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="updateDeadline">Deadline</label>
                                    <input type="text" class="form-control" id="date-time" placeholder="日時を選択してください" name="updateDeadline" value="{{ $todo->deadline }}">
                                </div>                          
                            </div>
    
                            @if ($errors->has('updateDeadline'))
                            <p class="alert alert-danger">{{ $errors->first('updateDeadline') }}</p>
                            @endif
    
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="submit" class="btn btn-outline-dark" value="Todoリストを更新">
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

