<ul class="nav-main">
    <li class="nav-main-heading">Administrator</li>
    @foreach(__('navbar.admin') as $key => $nav)
        @if($nav['type'] == 1)
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ $nav['route'] ? route($nav['route']) : '' }}">
                    <i class="nav-main-link-icon @if(isset($nav['icon'])) {{ $nav['icon'] }} @endif"></i>
                    <span class="nav-main-link-name">{{ $nav['title'] }}</span>
                </a>
            </li>
        @endif
        @if($nav['type'] == 2)
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon @if(isset($nav['icon'])) {{ $nav['icon'] }} @endif"></i>
                        <span class="nav-main-link-name">{{ $nav['title'] }}</span>
                    </a>
                    <ul class="nav-main-submenu">
                        @foreach($nav['items'] as $navItem)
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ $navItem['route'] ? route($navItem['route']) : '' }}">
                                    <i class="nav-main-link-icon @if(isset($navItem['icon'])) {{ $navItem['icon'] }} @endif"></i>
                                    <span class="nav-main-link-name">{{ $navItem['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
    @endforeach
</ul>
