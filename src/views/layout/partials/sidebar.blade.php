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

            <li class="nav-item">
                <a class="nav-link" href="{{route('wordit.admin.user.index')}}"><i class="fa fa-users"></i> Użytkownicy</a>
            </li>
            @dd(do_hook('admin_menu'))
            @if (do_hook('admin_menu'))
                @foreach (do_hook('admin_menu') as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wordit.admin.user.index')}}"><i class="fa fa-users"></i> {{$menu['single_name']}}</a>
                    </li>
                @endforeach
            @endif

            @if (!empty(config('wordit.models')))
                @foreach (config('wordit.models') as $model)
                    @php
                        $model = new $model['model'];
                    @endphp

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wordit.admin.'.$model->getRouteName().'.index')}}">{{$model->label('plural_name')}}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
