@extends('layouts.app')

@section('subnav')  
<div id="sub-nav-bar" class="nav bg-dark">
    <div class="container d-flex flex-row justify-content-between"> 
        <div class="d-flex flex-row justify-content-start"> 
            <div class="my-1" style="font-size: 1em;">
                <a href="{{ route('home') }}" class="btn-outline-primary p-2"><i class="fas fa-home"></i> <span class="pc-only">ホーム<span> </a>    
            </div>
            <div class="my-1" style="font-size: 1em;">
                <a href="{{ route('todos.index') }}" class="btn-outline-primary p-2"><i class="fas fa-list-alt"></i> <span class="pc-only">一覧<span> </a>    
            </div>
            <div class="my-1" style="font-size: 1em;">
                <a href="{{ route('todos.create') }}" class="btn-outline-primary p-2"><i class="fas fa-plus-circle"></i> <span class="pc-only">新規<span> </a>   
            </div>
            @yield('sub-nav-left')
        </div>  
        <div class="d-flex flex-row justify-content-end align-items-center"> 
            @yield('sub-nav-right')
        </div> 
    </div>    
</div>
@endsection