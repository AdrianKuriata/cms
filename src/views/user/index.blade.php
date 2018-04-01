@extends('wordit::layout.app')

@section('title-page', 'Użytkownicy - Panel zarządzania')

@section('title-description', 'Użytkownicy panelu zarządzania treścią')

@section('wordit::content')
<h3 class="tile-title mb-0">
    Użytkownicy
</h3>
<small>
    Zarejestrowanych użytkowników: {{$users->count()}}
</small>

<table class="table table-hover mt-3">
    <thead>
        <th>
            Nazwa
        </th>
        <th>
            Adres e-mail
        </th>
        <th>
            Grupa
        </th>
        <th>
        </th>
    </thead>

    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    Administrator
                </td>
                <td>
                    cos
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    Przykro nam, ale nie znaleziono żadnych zarejestrowanych użytkowników.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
