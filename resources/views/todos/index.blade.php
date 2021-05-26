@extends('layouts.subnav')

@section('content')
<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="width: 54%">Todo</th>
                <th scope="col" class="pc-only">期限</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
            <tr>
                <td class="todo pc-only">{{ $todo->todo }}</td>
                <td class="pc-only" value="deadline">{{ $todo->deadline->format('n月d日 H:i') }}</td>

                <td class="mobile-only">
                    <span>{{ $todo->todo }}</span>
                    <br>
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
