@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- ログイン後の画面 -->
            <!-- ＋ボタン -->
            <ul class="menu-icon clearfix">
                <li class="accordion">
                    <a href="{{ url('/todos') }}"></a>
                </li>
            </ul>

            <tbody>
            </tbody>
        </div>
    </div>
    <div class="container">
        <div id="canvasContainer">
        </div>
        <div id="popup"></div>
    </div>
</div>
@endsection
@section('home-js')
<script>
        window.taskObj = @json($todos);
        window.dtoday = @json($dtoday);
        window.d3DaysLater = @json($d3DaysLater);
        window.d7DaysLater = @json($d7DaysLater);
</script>
<script src="{{ asset('js/home.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.min.js"></script>

@endsection