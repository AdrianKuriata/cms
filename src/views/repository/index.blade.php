@extends('wordit::layout.app')

@section('title-page', 'Repozytoria - Panel zarządzania')

@section('title-description', 'Repozytoria panelu zarządzania treścią')

@section('wordit::content')
<div class="tile">
    <div class="tile-body">
        <ul class="list-group d-none mb-3" id="display-update-info">
        </ul>

        <h3 class="tile-title mb-0">
            Repozytoria
            <div class="btn btn-primary btn-sm float-right clearfix" id="repositories-upgrade" data-url="{{route('wordit.admin.core.upgrade')}}">
                Aktualizuj wszystko
            </div>
            <div class="btn btn-primary btn-sm float-right clearfix mr-1" id="repositories-refresh">
                <i class="fa fa-refresh mr-0"></i>
            </div>
            <div class="btn btn-primary btn-sm float-right clearfix mr-1">
                <i class="fa fa-plus mr-0"></i>
            </div>
        </h3>
        <small>
            Zainstalowanych repozytoriów: <span id="repository-count"><i class="fa fa-circle-o-notch fa-spin"></i></span>
        </small>
        <table class="table table-hover mt-3">
            <thead>
                <th>
                    Repozytorium
                </th>
                <th>
                    Aktualna wersja
                </th>
                <th>
                    Nowa wersja
                </th>
            </thead>

            <tbody id="repositories" data-load-repositories="{{route('wordit.admin.core.repositories')}}">
                <tr v-if="repositories.length > 0" v-for="repo in repositories">
                    <td>
                        <span v-if="repo[2] != undefined && repo[1] != repo[2]" style="color: red; font-weight: bold;">@{{repo[0]}}</span>

                        <span v-else>@{{repo[0]}}</span>
                    </td>
                    <td>
                        @{{repo[1]}}
                    </td>
                    <td>
                        @{{repo[2] == undefined? 'Aktualna' : repo[2]}}
                    </td>
                </tr>

                <tr v-if="waitForRepositories">
                    <td colspan="5" class="text-center">
                        <h3><i class="fa fa-circle-o-notch fa-spin mr-3"></i> Wczytywanie, proszę czekać ...</h3>
                    </td>
                </tr>

                <tr v-else-if="repositories.length == 0">
                    <td colspan="5">
                        Nie ma żadnych repozytoriów do zaktualizowania.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
