@extends('layouts.app')

@section('title', config('app.name', 'Laravel blog'))

@section('content')
    @foreach($articles as $article)
        <div class="card">
            <h5 class="card-header">{{$article->title}}</h5>
            <div class="card-body">
                <h5 class="card-title">{{$article->title}}</h5>
                <p class="card-text">{{$article->description_short}}</p>
                <a href="{{route('article', $article->slug)}}" class="btn btn-primary">подробнее...</a>
            </div>
        </div>
    @endforeach

    <nav aria-label="...">
        <ul class="pagination pagination-lg">
            <li class="page-item">{{$articles->links()}}</li>
        </ul>
    </nav>


@endsection
