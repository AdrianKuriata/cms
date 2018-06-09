@extends('wordit::layout.app')

@section('title-page', $model->label('plural_name') . ' - Aktualizowanie - Panel zarządzania')

@section('title-description',  $model->label('plural_name') . ' panelu zarządzania treścią')

@section('wordit::content')
    @include('wordit::model.partials.form', ['editable' => true, 'btn_text' => $model->label('update_item')])
@endsection
