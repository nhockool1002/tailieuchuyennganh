<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('home') }}" target="_blank" class="simple-text">
                    {{ \Constant::TITLE_NAME_TOP }}
                </a>
            </div>

            <ul class="nav">
                <li {{{ (Request::is('backend') ? 'class=active' : '') }}} >
                    <a href="{{ route('dashboard') }}">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/user*') ? 'class=active' : '') }}}{{{ (Request::is('backend/filter*') ? 'class=active' : '') }}}>
                    <a href="{{ route('user') }}">
                        <i class="ti-user"></i>
                        <p>Users Manager</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/category*') ? 'class=active' : '') }}}>
                    <a href="{{ route('category') }}">
                        <i class="ti-folder"></i>
                        <p>Categories Manager</p>
                    </a>
                </li>
                @endif
                <li {{{ (Request::is('backend/post*') ? 'class=active' : '') }}}>
                    <a href="{{ route('post') }}">
                        <i class="ti-comment-alt"></i>
                        <p>Posts Manager</p>
                    </a>
                </li>
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/page*') ? 'class=active' : '') }}}>
                    <a href="{{ route('page') }}">
                        <i class="ti-blackboard"></i>
                        <p>Pages Manager</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/menu*') ? 'class=active' : '') }}}>
                    <a href="{{ route('menu') }}">
                        <i class="ti-direction-alt"></i>
                        <p>Menu Configure</p>
                    </a>
                </li>
                @endif
                <li {{{ (Request::is('backend/links*') ? 'class=active' : '') }}}>
                    <a href="{{ route('link') }}">
                        <i class="ti-world"></i>
                        <p>Links Manager</p>
                    </a>
                </li>
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/ads*') ? 'class=active' : '') }}}>
                    <a href="{{ route('ads') }}">
                        <i class="ti-shield"></i>
                        <p>Ads Manager</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id ==1 || Auth::user()->role_id ==2)
                <li {{{ (Request::is('backend/settings*') ? 'class=active' : '') }}}>
                    <a href="{{ route('setting') }}">
                        <i class="ti-settings"></i>
                        <p>Settings Content</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id ==1)
                <li {{{ (Request::is('backend/log*') ? 'class=active' : '') }}}>
                    <a href="{{ route('log') }}">
                        <i class="ti-bookmark"></i>
                        <p>Logs Manager</p>
                    </a>
                </li>
                @endif
            </ul>
    	</div>
    </div>
