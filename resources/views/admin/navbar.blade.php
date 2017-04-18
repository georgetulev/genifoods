<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li class="{{ Request::is('analysis*') ? 'active' : '' }}"><a href="{{ URL::to('analysis') }}">Анализи</a>
        <li class="{{ Request::is('results*') ? 'active' : '' }}"><a href="{{ URL::to('results') }}">Резултати</a></li>
        @if (Auth::user()->hasRole('admin'))
            <li class="{{ Request::is('groups*') ? 'active' : '' }}"><a href="{{ URL::to('groups') }}">Гени</a></li>
            <li class="{{ Request::is('genes*') ? 'active' : '' }}"><a href="{{ URL::to('genes') }}">Полиморфизми</a></li>
            <li class="{{ Request::is('recommendations*') ? 'active' : '' }}"><a href="{{ URL::to('recommendations') }}">Препоръки</a></li>
        @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if(Auth::user()->hasRole('admin'))
            <li class="{{ Request::is('users*') ? 'active' : '' }}"><a href="{{ URL::to('users') }}">Потребители</a></li>
        @endif
        <li><a href="{{ URL::to('logout') }}">Изход</a></li>
    </ul>
</nav>
