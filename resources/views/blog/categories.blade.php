@extends('layouts.app')

@section('content')
    <div class="container">
        @forelse($categories as $category)
            <div class="row">
                <div class="col-sm-12">
                    <h3><a href="{{route('category', $category->slug)}}">{{$category->title}}</a></h3>
                </div>
            </div>
        @empty
            <h2 class="text-container">Пусто...</h2>
        @endforelse
    </div>
@endsection