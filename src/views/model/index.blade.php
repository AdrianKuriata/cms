@extends('wordit::layout.app')

@section('title-page', $model->label('plural_name') . ' - Panel zarządzania')

@section('title-description',  $model->label('plural_name') . ' panelu zarządzania treścią')

@section('wordit::content')
    <h3 class="tile-title mb-0">
        {{$model->label('plural_name')}}
        <div class="float-right clearfix">
            <a href="{{route('wordit.admin.'.$model->getRouteName().'.create.get')}}" class="btn btn-primary"><i class="fa fa-plus mr-0"></i></a>
        </div>
    </h3>
    <small>
        Utworzonych {{strtolower($model->label('count_item'))}}: {{$collection->count()}}
    </small>
    <table class="table table-hover mt-3">
        <thead>
            @foreach ($model->getTableFields() as $field)
                <th>
                    {{$field['display_name']}}
                </th>
            @endforeach
            <th style="width: 10%;">
            </th>
        </thead>

        <tbody>
            @forelse ($collection as $collect)
                <tr>
                    @foreach ($model->getTableFields() as $field)
                        <th>
                            @php
                                if (isset($field['relation'])) {
                                    echo $collect->{$field['relation']['name']}->{$field['relation']['relation_display_field']};
                                } else {
                                    echo $collect->{$field['name']};
                                }
                            @endphp
                        </th>
                    @endforeach
                    <td>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil mr-0"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times mr-0"></i></a>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="{{count($model->getTableFields()) + 1}}">
                    Nie znaleziono żadnych danych do wyświetlenia.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
