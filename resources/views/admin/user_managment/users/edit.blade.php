@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('title') Редактирование пользователя @endslot
            @slot('parent') Главная @endslot
            @slot('active') Пользователи @endslot
        @endcomponent

        <hr>

        <form action="{{route('admin.user_managment.user.update', $user)}}" class="form-horizontal" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}

            {{--Form include--}}
            @include('admin.user_managment.users.partials.form')

        </form>

@endsection