@if (isset($editable) && $editable)
    {!! Form::model($model_data, ['method' => 'POST', 'class' => 'form-add-edit', 'route' => ['wordit.admin.' . $model->getRouteName() . '.update.post', $model_data->id]]) !!}
@else
    {!! Form::open(['method' => 'POST', 'class' => 'form-add-edit', 'route' => 'wordit.admin.' . $model->getRouteName() . '.create.post']) !!}
@endif
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
                {!! Form::submit($btn_text, ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
