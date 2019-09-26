@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('title') Список статей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Статьи @endslot
        @endcomponent

        <hr>

        <form action="{{route('admin.article.store')}}" class="form-horizontal" method="post">
            {{csrf_field()}}

            {{--Form include--}}
            @include('admin.articles.partials.form')

            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
        </form>

@endsection