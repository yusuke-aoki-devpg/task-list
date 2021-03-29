@extends('layouts.app')

@section('sub-nav-left')
<div class="my-1" style="font-size: 1em;">
    <a href="{{ route('todos.create') }}" class="btn-outline-light p-2"><i class="fas fa-plus-circle"></i> <span class="pc-only">新規<span> </a>   
</div>
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
<div id="msgContainer" class="text-right text-danger px-2 "></div>
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
                {{ Form::submit('削除', array('class'=>'text-white btn btn-sm','style' => 'background-color:transparent;')) }}
                {!! Form::close() !!}
            </div>        
        </div>
        @endforeach
</div>

<div id="listViewContainer"  class="mobile-only"  style="display: none">
    <div class="container">
        <table class="table">
            <tbody>
                @foreach ($todos as $index => $todo)
                @if ($todo->deadline->format("Y-m-d") === $dtoday)
                    <tr style="background-color: rgb(240,119,110);">
                @elseif($todo->deadline->format("Y-m-d") > $dtoday && $todo->deadline->format("Y-m-d") <= $d3DaysLater)
                    <tr style="background-color: rgb(255,242,105);">
                        @elseif($todo->deadline->format("Y-m-d") > $d3DaysLater && $todo->deadline->format("Y-m-d") <= $d7DaysLater)
                        <tr style="background-color: rgb(170,250,170);">
                            @endif
                {{-- <tr class="bg-primary"> --}}

                    <td>
                        <span>{{ $todo->todo }}</span>
                        <br >
                        <small value="deadline">{{ $todo->deadline->format('n月d日 H:i') }}</small>
                    </td>

                    <td><a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm" style="background-color:transparent;">編集</a></td>
                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td>{{ Form::submit('削除', array('class'=>'btn btn-sm','style' => 'background-color:transparent;')) }}</td>
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