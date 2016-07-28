<ul class="sidebar-menu">
    
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li class="treeview">
        @can('admin')
            <a href="#"><i class="fa fa-user"></i> <span>users</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
        @endcan
        <ul class="treeview-menu">
            <li><a href="{{ url('users') }}">View all</a></li>
            <li><a href="{{ url('users/create') }}">Add</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-envelope"></i> <span>foods</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('foods') }}">View all</a></li>
            <li><a href="{{ url('foods/create') }}">Add</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-minus"></i> <span>categories</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('categories') }}">View all</a></li>
            <li><a href="{{ url('categories/create') }}">Add</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-circle"></i> <span>pages</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('pages') }}">View all</a></li>
            <li><a href="{{ url('pages/create') }}">Add</a></li>
        </ul>
    </li>
</ul>