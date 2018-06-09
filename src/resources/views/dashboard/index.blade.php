@extends('wordit::layout.app')

@section('title-page', 'Strona główna - Panel zarządzania')

@section('title-description', 'Strona główna panelu zarządzania treścią')

@section('wordit::content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card card-accent-secondary dashboard-core">
            <div class="card-header">
                Laravel
            </div>
            <div class="card-body">
                Jest to rdzeń całej Twojej strony, wymagany do tego, aby wszystko działało tak jak powinno, postaraj się, aby zawsze był aktualny.
                <div class="mt-3">
                    Twórca: Taylor Otwell<BR  />
                    <span class="core-version" title="Jest to najnowsza wersja" data-current="v5.6.14">Wersja: v5.6.14 <i class="fa fa-check"></i></span>
                </div>

                <div class="mt-3 logs d-none">
                    <h5>Działania</h5>
                    <div class="list-group list-log">

                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-primary d-none" data-action="upgrade-core" data-url="{{route('wordit.admin.core.upgrade')}}" data-log="{{route('wordit.admin.core.upgrade.log')}}">Aktualizuj</button>
                <button type="button" class="btn btn-primary" data-action="check-upgrade-core" data-url="{{route('wordit.admin.core.check')}}">Sprawdź aktualizacje</button>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card card-accent-secondary">
            <div class="card-header">
                Wordit
            </div>
            <div class="card-body">
                Jest to Twój panel oraz system zarządzania treścią, jest dosyć często aktualizowany więc postaraj się, aby był w ostatniej dostępnej wersji.
                <div class="mt-3">
                    Twórca: Adrian Kuriata<BR  />
                    <span title="Jest to najnowsza wersja">Wersja: 0.1-alpha-1 <i class="fa fa-check"></i></span>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-primary" data-action="upgrade-system">Sprawdź aktualizacje</button>
                <button type="button" class="btn btn-primary" data-action="latest-system-changes">Sprawdź ostatnie zmiany</button>
            </div>
        </div>
    </div>
</div>
@endsection
