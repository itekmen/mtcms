<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li><a href="{{url('/')}}" class="@if(Request::segment(1)=="dashboard" || Request::segment(1)=="") active @endif"><i class="fa fa-dashboard fa-fw"></i> Anasayfa</a></li>
            <li class="@if(Request::segment(1)=="settings") active @endif">
                <a href="#" class="@if(Request::segment(1)=="settings") active @endif"><i class="fa fa-wrench fa-fw"></i> Ayarlar<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{url('settings/users')}}" class="@if(Request::segment(2)=="users") active @endif">Kullanıcı Yönetimi</a></li>
                    <li><a href="{{url('settings/groups')}}" class="@if(Request::segment(2)=="groups") active @endif">Grup Yönetimi</a></li>
                    <li><a href="{{url('settings/config')}}" class="@if(Request::segment(2)=="config") active @endif">Tanımlamalar</a></li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>