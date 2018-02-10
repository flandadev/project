{{--

<style>
  ul {
    list-style-type: none !important;
  }

  .username-toggle {
    color: white !important;
    cursor: pointer;
  }

  .dropdown-menu {
    top: 114% !important;
  }

  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
  }

  .dropdown-submenu:hover>.dropdown-menu {
    display: block;
  }

  .dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
  }

  .dropdown-submenu:hover>a:after {
    border-left-color: #fff;
  }

  .dropdown-submenu.pull-left {
    float: none;
  }

  .dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
  }
</style>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#"> ADMIN </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ \Route::current()->uri == 'admin' ? 'active' : '' }}">
        <a class="nav-link" href="/admin"> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          Events
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/admin/events"> All </a>
          <a class="dropdown-item" href="/admin/events/create"> New </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <ul class="dropdown-menu multi-level">
          <a class="dropdown-item" href="/admin/users"> Admins </a>
          <ul class="dropdown-item dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Customers </a>
            <ul class="dropdown-menu">
              <a class="dropdown-item" href="/admin/customers">List </a>
              <a class="dropdown-item" href="/admin/customers/create">Add </a>
            </ul>
          </ul>
        </ul>
      </li>
      <li class="nav-item {{ \Route::current()->uri == 'admin/tickets' ? 'active' : '' }}">
        <a class="nav-link" href="/admin/tickets"> Tickets Check </a>
      </li>
    </ul>
    <ul class="nav">
      <li class="nav-item dropdown">
        <div class="nav-link dropdown-toggle username-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          {{ auth()->user()->username  }}
        </div>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/admin/logout"> Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
--}}

<nav id="admin-navbar" class="stellarnav">
  <ul>
    <li><a href="/admin">Home</a></li>
		<li><a href="/admin/tickets">Tickets</a></li>
    <li><a href="#"> Events </a>
      <ul>
        <li><a href="/admin/events"> List </a></li>
        <li><a href="/admin/events/create"> Create New </a></li>
      </ul>
    </li>
    <li><a href="#"> Customers </a>
      <ul>
        <li><a href="/admin/customers"> Show </a></li>
        <li><a href="/admin/customers/create"> Register </a></li>
      </ul>
    </li>
    <li><a href="#"> Admins </a>
      <ul>
        <li><a href="/admin/users"> List </a></li>
        <li><a href="/admin/users/create"> Create new </a></li>
      </ul>
    </li>
    <li class="username"> <div class="status {{$status}}"></div><a id="logged" href="#"> {{ auth()->user()->username }}</a>
      <ul>
        <li><a href="/admin/settings"> Settings </a></li>
        <li><a href="/admin/logout"> Log Out</a></li>
      </ul>
    </li>
  </ul>
</nav>
