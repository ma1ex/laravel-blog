@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('title') Создание пользователя @endslot
            @slot('parent') Главная @endslot
            @slot('active') Пользователи @endslot
        @endcomponent

        <hr>

        <form action="{{route('admin.user_managment.user.store')}}" class="form-horizontal" method="post">
            {{csrf_field()}}

            {{--Form include--}}
            @include('admin.user_managment.users.partials.form')

        </form>

@endsection