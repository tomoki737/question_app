@extends('app')

@section('title', '一覧画面')

@section('content')
@include('nav')
<div class="container" style="max-width: 800px;">
    <div class="row">
        @include('tabs', ['hasSolve' => false, 'hasUnSolve' => true])
        @foreach($questions as $question)
        @include('card')
        @endforeach
    </div>
</div>
@endsection
