@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="card-deck">

                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title">Категории</h4>
                        <p class="card-text">Категорий: {{$count_categories}}</p>
                    </div>
                </div>

                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h4 class="card-title">Статьи</h4>
                        <p class="card-text">Статей: {{$count_articles}}</p>
                    </div>
                </div>

                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title">Посетители</h4>
                        <p class="card-text">Посетителей 0</p>
                    </div>
                </div>

                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h4 class="card-title">Сегодня</h4>
                        <p class="card-text">Сегодня 0</p>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <a class="btn btn-block btn-outline-primary" href="{{route('admin.category.create')}}">Создать категорию</a>

                <div>&nbsp;</div>
                <h4 class="list-group-item-heading">Категории:</h4>
                <ul class="list-group">
                    @foreach($categories as $category)
                        <a href="{{route('admin.category.edit', $category)}}"><li class="list-group-item d-flex justify-content-between align-items-center">{{$category->title}} <span class="badge badge-primary badge-pill">{{$category->articles()->count()}}</span></li></a>
                    @endforeach
                </ul>

            </div>
            <div class="col-sm-6">
                <a class="btn btn-block btn-outline-primary" href="#">Создать материал</a>

                <div>&nbsp;</div>
                <h4 class="list-group-item-heading">Статьи:</h4>
                @foreach($articles as $article)
                <a class="list-group-item" href="{{route('admin.article.edit', $article)}}">
                    <h4 class="list-group-item-heading">{{$article->title}}</h4>
                    <p class="list-group-item-text">
                        Категории: {{$article->categories()->pluck('title')->implode(', ')}}
                    </p>
                </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection