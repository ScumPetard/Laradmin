<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs" style="font-size:20px;">
                                <i class="fa fa-pagelines" aria-hidden="true"></i>
                                <strong class="font-bold">{{ lang('Laradmin') }}</strong>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">L
                </div>
            </li>
            <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span class="ng-scope">基本</span>
            </li>
            <li>
                <a class="J_menuItem" href="{{ route('admin.index') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">主页</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">用户</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ route('admin.user.index') }}">用户管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ route('admin.role.index') }}">角色管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ route('admin.permission.index') }}">权限管理</a>
                    </li>
                </ul>
            </li>
            <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span class="ng-scope">用户操作</span>
            </li>
            <li class="line dk"></li>
            <li>
                <a href="{{ route('admin.signout') }}"><i class="fa fa-sign-out"></i> <span class="nav-label">退出</span></a>
            </li>
        </ul>
    </div>
</nav>