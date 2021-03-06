<!-- Default Bootstrap NavBar --!>
<nav class="navbar navbar-expand-lg navbar-light bg-nav">
  <a class="navbar-brand" href="{{ url('/') }}">Task List</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @can('tasks-admin')
        <li class="nav-item {{ (Request::is('tasks/create')) ? "active" : "" }}">
          <a class="nav-link " href="{{ url('tasks/create') }}">Create</a>
        </li>
      @endcan
    </ul>
    <ul class="navbar-nav mx-sm-1">
    @if (Auth::check())
      <li class="nav-item dropdown mr-150">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        @can('tasks-admin')
          <a class="dropdown-item" href="{{ route('tasks.create') }}">Create Tasks</a>
          <a class="dropdown-item" href="{{ route('tasks.gen') }}">Gen Tasks</a>
        @endcan
          <a class="dropdown-item" href="{{ route('pages.index') }}">MyTasks</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>
        </div>
      </li>
    @else
        <a href="{{ route('login')}}" class="btn btn-earls-green">Login</a>
    @endif
    </ul>
  </div>
</nav>
<!--/Default Bootstrap NavBar --!>
