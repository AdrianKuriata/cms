@extends('wordit::layout.app')

@section('title-page', 'Aktualizowanie grupy - Panel zarządzania')

@section('title-description', 'Aktualizowanie grupy w panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::groups.partials.form', ['is_edit' => true])
@endsection
