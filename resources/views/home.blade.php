@extends('layouts.subnav')

@section('sub-nav-left')
<div id="changeView" class="my-1 mobile-only" style="font-size: 1em;">
    <a href="#" class="btn-outline-light p-2"><i class="fas fa-exchange-alt"></i></a>   
</div>
@endsection

@section('sub-nav-right')
<div class="text-white">
    <div id="task-msg">今週のタスク：<span id="task-num"> {{count($todos)}} </span></div>
</div>
@endsection

@section('content')
<div id="msgContainer" class="text-right text-danger px-2 bg-primary" style="display: block"></div>
<div class="container">
        <div id="canvasContainer"></div>
        @foreach ($todos as $index => $todo)
        <div id="popup{{ $todo->id }}" class="popup" name="popup" style="display: none">
            <div class="popuptext">
                <div class="p-1 text-white"> {{ $todo->todo }} </div>
            </div>        
            <div class="popuptext option">
                <div><a class="text-white btn btn-sm" href=" {{ route('todos.edit', $todo->id)}} ">編集</a></div>　
                {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST'])!!}
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                {{ Form::submit('削除', array('class'=>'btn btn-sm btn-link')) }}
                {!! Form::close() !!}
            </div>        
        </div>
        @endforeach
</div>

<div id="listViewContainer"  class="mobile-only"  style="display: none">
    <div class="container mt-2">
        <table class="table text-dark">
            <thead>
                <tr>
                    <th scope="col" style="width: 54%"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $index => $todo)
                    @if ($todo->deadline->format("Y-m-d") === $dtoday)
                        <tr style="background-color: rgba(231,32,100,255);">
                    @elseif($todo->deadline->format("Y-m-d") > $dtoday && $todo->deadline->format("Y-m-d") <= $d3DaysLater)
                        <tr style="background-color: rgba(251,192,13,255);">
                    @elseif($todo->deadline->format("Y-m-d") > $d3DaysLater && $todo->deadline->format("Y-m-d") <= $d7DaysLater)
                        <tr style="background-color: rgba(129,201,45,255);">
                    @endif

                    <td>
                        <span>{{ $todo->todo }}</span>
                        <br >
                        <small value="deadline">{{ $todo->deadline->format('n月d日 H:i') }}</small>
                    </td>

                    <td><a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-outline-dark">編集</a></td>
                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td>{{ Form::submit('削除', array('class'=>'btn btn-sm btn-outline-dark')) }}</td>
                    {!! Form::close() !!}
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection

@section('extra-js')
<script>
        window.taskObj = @json($todos);
        window.dtoday = @json($dtoday);
        window.d3DaysLater = @json($d3DaysLater);
        window.d7DaysLater = @json($d7DaysLater);
</script>
<script src="{{ asset('js/home.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.min.js"></script>
@endsection