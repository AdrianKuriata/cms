@extends('wordit::layout.app')

@section('title-page', $model['labels']['plural_name'] . ' - Tworzenie - Panel zarządzania')

@section('title-description',  $model['labels']['plural_name'] . ' panelu zarządzania treścią')

@section('wordit::content')
<div class="form-loader d-flex align-items-center justify-content-center">
    <h1><i class="fa fa-circle-o-notch fa-spin"></i></h1>
</div>
    {!! Form::open(['method' => 'POST', 'class' => 'form-add-edit', 'route' => 'wordit.admin.' . $model['route_name'] . '.create.post']) !!}
    <div class="form-row">
        <div class="col-12 col-lg-8">
            <div class="form-row">
                @forelse ($model['form'] as $form)
                    <div class="{{$form['class']}}">
                        <div class="form-group">
                            {!! Form::label($form['name'], $form['label']) !!}
                            {!! Form::{$form['type']}($form['name'], null, ['class' => 'form-control', 'placeholder' => $form['placeholder']]) !!}
                        </div>
                    </div>
                @empty
                    <h2>Nie dodałeś żadnych pól, zrób to, aby móc utworzyć wartość.</h2>
                @endforelse
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="form-row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::submit($model['labels']['add_item'], ['class' => 'btn btn-primary float-right']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
