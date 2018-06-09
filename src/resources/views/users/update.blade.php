@extends('wordit::layout.app')

@section('title-page', 'Aktualizowanie użytkownika - Panel zarządzania')

@section('title-description', 'Aktualizowanie użytkownika w panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::users.partials.form', ['is_edit' => true])
@endsection
