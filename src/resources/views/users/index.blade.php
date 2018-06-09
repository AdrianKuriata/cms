@extends('wordit::layout.app')

@section('title-page', 'Użytkownicy - Panel zarządzania')

@section('title-description', 'Użytkownicy panelu zarządzania treścią')

@section('wordit::content')
    <div class="card">
        <div class="card-body">
            <h3 class="tile-title mb-0">
                Użytkownicy
            </h3>
            <small>
                Zarejestrowanych użytkoników: {{$users->count()}}
            </small>
            <a href="{{route('wordit.admin.users.create.get')}}" class="btn btn-primary float-right" title="Utwórz nową grupę"><i class="fa fa-plus"></i></a>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>
                            Nazwa
                        </th>
                        <th>
                            E-mail
                        </th>
                        <th>
                            Grupa
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>

                <thead>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->group->name?? 'Brak danych'}}
                        </td>
                        <td>
                            <a href="{{route('wordit.admin.users.update.get', $user->id)}}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                            <button type="button" data-href="{{route('wordit.admin.users.delete', $user->id)}}" class="btn btn-danger delete-item"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">
                            Przykro nam, ale żaden użytkownik nie został jeszcze utworzony.
                        </td>
                    </tr>
                    @endforelse
                </thead>
            </table>

            {!! $users->render() !!}
        </div>
    </div>
@endsection
