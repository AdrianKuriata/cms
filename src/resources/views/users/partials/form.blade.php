@if (isset($is_edit) && $is_edit == true)
{!! Form::model($user, ['method' => 'POST', 'class' => 'form-add-edit', 'route' => ['wordit.admin.users.update.post', $user->id]]) !!}
@else
{!! Form::open(['method' => 'POST', 'class' => 'form-add-edit', 'route' => 'wordit.admin.users.create.post']) !!}
@endif
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                Treść
            </div>

            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('name', 'Nazwa', ['class' => 'required']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nazwa użytkownika']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'E-mail', ['class' => 'required']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Adres e-mail']) !!}
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
                    {!! Form::label('group_id', 'Grupa użytkownika', ['class' => 'required']) !!}
                    {!! Form::select('group_id', $groups, null, ['class' => 'form-control', 'placeholder' => 'Wybierz grupę użytkownika']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Aktualizuj', ['class' => 'btn btn-success btn-block']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
