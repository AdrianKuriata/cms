@extends('wordit::layout.app')

@section('title-page', $model->label('plural_name') . ' - Tworzenie - Panel zarządzania')

@section('title-description',  $model->label('plural_name') . ' panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::model.partials.form', ['btn_text' => $model->label('add_item')])
@endsection
