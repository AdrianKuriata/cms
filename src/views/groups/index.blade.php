@extends('wordit::layout.app')

@section('title-page', 'Grupy - Panel zarządzania')

@section('title-description', 'Grupy panelu zarządzania treścią')

@section('wordit::content')
    <div class="card">
        <div class="card-body">
            <h3 class="tile-title mb-0">
                Grupy
            </h3>
            <small>
                Utworzonych grup: {{$groups->count()}}
            </small>
            <a href="{{route('wordit.admin.groups.create.get')}}" class="btn btn-primary float-right" title="Utwórz nową grupę"><i class="fa fa-plus"></i></a>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>
                            Nazwa
                        </th>
                        <th>
                            Użytkowników
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>

                <thead>
                    @forelse($groups as $group)
                    <tr>
                        <td>
                            {{$group->name}}
                        </td>
                        <td>
                            {{$group->users_count}}
                        </td>
                        <td>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            Przykro nam, ale żadna z grup nie została jeszcze utworzona
                        </td>
                    </tr>
                    @endforelse
                </thead>
            </table>

            {!! $groups->render() !!}
        </div>
    </div>
@endsection
