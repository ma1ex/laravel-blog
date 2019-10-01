@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('title') Список пользователей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Пользователи @endslot
        @endcomponent

        <hr>

        <a href="{{route('admin.user_managment.user.create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus-square-o"></i> Новый пользователь
        </a>

        <table class="table table-striped">
            <thead>
            <th>Имя</th>
            <th>Email</th>
            <th class="text-right">Действие</th>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Удалить пользователя?')) {return true} else {return false}" action="{{route('admin.user_managment.user.destroy', $user)}}" method="post">
                            {{method_field('delete')}}
                            {{ csrf_field() }}
                            <a class="btn btn-default" href="{{route('admin.user_managment.user.edit', $user)}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <nav aria-label="...">
                        <ul class="pagination">
                            {{$users->links()}}
                        </ul>
                    </nav>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>

@endsection