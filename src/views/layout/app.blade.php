<!DOCTYPE html>
<html lang="pl">
<head>
    @include('wordit::layout.partials.header')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <!-- Navigation -->
    @include('wordit::layout.partials.navbar')

    <div class="app-body">
        @include('wordit::layout.partials.sidebar')
        @include('wordit::layout.partials.content')
    </div>

    @include('wordit::layout.partials.footer')
</body>
</html>
