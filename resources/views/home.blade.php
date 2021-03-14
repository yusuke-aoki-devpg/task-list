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
                @foreach ($todos ?? '' as $todo)
                <tr>
                    <th scope="row" class="todo">{{ $todo->todo }}</th>
                    <td>{{ $todo->deadline->format('n月d日 H:i') }}</td>
                </tr>
                
                <br>
                @endforeach
            </tbody>




        </div>
    </div>
</div>
@endsection