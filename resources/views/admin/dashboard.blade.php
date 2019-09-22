@extends('admin.layouts.app_admin')

@section('content')
{{--    <div class="card-body">--}}
{{--        @if (session('status'))--}}
{{--            <div class="alert alert-success" role="alert">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        You are logged in!--}}
{{--    </div>--}}

    <div class="container">
        <div class="row">
            <div class="card-deck">

                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title">Категории</h4>
                        <p class="card-text">Категорий 0</p>
                    </div>
                </div>

                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h4 class="card-title">Материалы</h4>
                        <p class="card-text">Материалов 0</p>
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
                <h4 class="list-group-item-heading">Категория первая</h4>
                <ul class="list-group">
                    <a href="!#"><li class="list-group-item d-flex justify-content-between align-items-center active">Cras justo odio <span class="badge badge-primary badge-pill">14</span></li></a>
                    <a href="!#"><li class="list-group-item d-flex justify-content-between align-items-center">Dapibus ac facilisis in <span class="badge badge-primary badge-pill">2</span></li></a>
                    <a href="!#"><li class="list-group-item d-flex justify-content-between align-items-center">Morbi leo risus <span class="badge badge-primary badge-pill">7</span></li></a>
                </ul>
                <p class="list-group-item-text">
                    Кол-во материалов
                </p>

            </div>
            <div class="col-sm-6">
                <a class="btn btn-block btn-outline-primary" href="#">Создать материал</a>

                <a class="list-group-item" href="#">
                    <h4 class="list-group-item-heading">Материал первый</h4>
                    <p class="list-group-item-text">
                        Категория
                    </p>
                </a>

                <a class="list-group-item" href="#">
                    <h4 class="list-group-item-heading">Материал первый</h4>
                    <p class="list-group-item-text">
                        Категория
                    </p>
                </a>

            </div>
        </div>
    </div>
@endsection