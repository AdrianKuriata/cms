<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
            <p class="app-sidebar__user-designation">Fullstack Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Strona główna</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('wordit.admin.dashboard.index')}}"><i class="icon fa fa-circle-o"></i> Strona główna</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Repozytoria</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('wordit.admin.repositories.index')}}"><i class="icon fa fa-circle-o"></i> Repozytoria</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Użytkownicy</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('wordit.admin.user.index')}}"><i class="icon fa fa-circle-o"></i> Wszyscy użytkownicy</a></li>
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Grupy</a></li>
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Twój profil</a></li>
            </ul>
        </li>
        <li>
        </li>
        @forelse (config('wordit.models') as $model)
            @php
                $model = new $model['model'];
            @endphp
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">{{$model->label('plural_name')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{route('wordit.admin.'.$model->getRouteName().'.index')}}"><i class="icon fa fa-circle-o"></i> {{$model->label('all_items')}}</a></li>
                    <li><a class="treeview-item" href="{{route('wordit.admin.'.$model->getRouteName().'.create.get')}}"><i class="icon fa fa-circle-o"></i> {{$model->label('add_item')}}</a></li>
                </ul>
            </li>
        @empty

        @endforelse
    </ul>
</aside>
