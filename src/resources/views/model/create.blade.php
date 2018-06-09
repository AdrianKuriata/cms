@extends('wordit::layout.app')

@section('title-page', $model->label('plural_name') . ' - Tworzenie - Panel zarządzania')

@section('title-description',  $model->label('plural_name') . ' panelu zarządzania treścią')

@section('wordit::content')
    {!! Form::open(['method' => 'POST', 'class' => 'form-add-edit', 'route' => 'wordit.admin.' . $model->getRouteName() . '.create.post']) !!}
    <div class="row">
        <div class="col-12 col-lg-8">
            @foreach ($model->getFormFieldsLeft() as $left)
                <div class="card">
                    <div class="card-header">
                        {{$left['title']}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($left['data'] as $data)
                                <div class="{{$data['class']}}">
                                    <div class="form-group">
                                        {!! Form::label($data['name'], $data['label']) !!}
                                        {!! Form::{$data['type']}($data['name'], null, ['class' => 'form-control', 'placeholder' => $data['placeholder']]) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-12 col-lg-4">
            @foreach ($model->getFormFieldsRight() as $right)
                <div class="card">
                    <div class="card-header">
                        {{$right['title']}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($right['data'] as $data)
                                <div class="{{$data['class']}}">
                                    <div class="form-group">
                                        {!! Form::label($data['name'], $data['label']) !!}
                                        {!! Form::{$data['type']}($data['name'], null, ['class' => 'form-control', 'placeholder' => $data['placeholder']]) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="card">
                <div class="card-header">
                    Publikacja
                </div>

                <div class="card-body">
                    {!! Form::submit($model->label('add_item'), ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
