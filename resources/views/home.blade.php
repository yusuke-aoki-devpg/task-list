@extends('layouts.app')

@section('content')
<div class="container">

    <!-- タスク表示 -->

    <div class="container">
        <div id="canvasContainer"></div>

        @foreach ($todos as $todo)
        <div id="popup{{ $todo->id }}" class="popup" name="popup">
            <div class="popuptext">
                <h4>{{ $todo->todo }}</h4>
            </div>
            <div class="popuptext option">
                <a href="{{ route('todos.edit', $todo->id) }}">編集</a>
                {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <td>{{ Form::submit('削除',['class' => 'delete-btn']) }}</td>
                {!! Form::close() !!}
            </div>
        </div>
        @endforeach
        
    </div>
<!-- Vue -->
    <!-- <div id="app">
    <example-component></example-component>
    </div> -->

</div>
@endsection
@section('home-js')
<!-- <script src=" {{ mix('js/app.js') }} "></script> -->
<script>

    window.taskObj = <?php echo json_encode($todos); ?>;
    window.dtoday = <?php echo json_encode($dtoday); ?>;
    window.d3DaysLater = <?php echo json_encode($d3DaysLater); ?>;
    window.d7DaysLater = <?php echo json_encode($d7DaysLater); ?>;
    
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('js/home.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.min.js"></script>

@endsection