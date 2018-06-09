@extends('wordit::layout.app')

@section('title-page', 'Tworzenie użytkownika - Panel zarządzania')

@section('title-description', 'Tworzenie użytkownika w panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::users.partials.form')
@endsection
