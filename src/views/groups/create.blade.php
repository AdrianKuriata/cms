@extends('wordit::layout.app')

@section('title-page', 'Tworzenie grupy - Panel zarządzania')

@section('title-description', 'Tworzenie grupy w panelu zarządzania treścią')

@section('wordit::content')
    {!! Form::open(['method' => 'POST', 'class' => 'form-add-edit', 'route' => 'wordit.admin.groups.create.post']) !!}
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                 Treść
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Nazwa', ['class' => 'required']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nazwa grupy']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('permissions', 'Uprawnienia') !!}

                        <div class="row">
                            @foreach ($permissions as $perm)
                            <div class="col-12 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input value="1" type="checkbox" name="{{$perm}}" class="custom-control-input" id="perm{{$loop->iteration}}">
                                    <label class="custom-control-label" for="perm{{$loop->iteration}}">{{title_case(str_replace('_', ' ', $perm))}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    Publikacja
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::submit('Aktualizuj', ['class' => 'btn btn-success btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
