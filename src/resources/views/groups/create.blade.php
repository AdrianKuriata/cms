@extends('wordit::layout.app')

@section('title-page', 'Tworzenie grupy - Panel zarządzania')

@section('title-description', 'Tworzenie grupy w panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::groups.partials.form')
@endsection
