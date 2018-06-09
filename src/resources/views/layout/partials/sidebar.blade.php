<!-- Sidebar menu-->
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('wordit.admin.dashboard.index')}}"><i class="fa fa-tachometer-alt"></i> Strona główna</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('wordit.admin.repositories.index')}}"><i class="fa fa-archive"></i> Repozytoria</a>
            </li>

            @can('view-group')
            <li class="nav-item">
                <a class="nav-link" href="{{route('wordit.admin.groups.index')}}"><i class="fa fa-users"></i> Grupy</a>
            </li>
            @endcan
            @can('view-user')
            <li class="nav-item">
                <a class="nav-link" href="{{route('wordit.admin.users.index')}}"><i class="fa fa-users"></i> Użytkownicy</a>
            </li>
            @endcan

            @if (!empty(config('wordit.models')))
                @foreach (config('wordit.models') as $model)
                    @php
                        $model = new $model;
                    @endphp

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wordit.admin.'.$model->getRouteName().'.index')}}"><i class="{{$model->label('icon')}}"></i> {{$model->label('plural_name')}}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
