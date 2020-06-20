<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark default-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="/"><i class="far fa-edit mr-2"></i>blog</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav ml-auto">
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">新規登録</a>
      </li>
      @endguest

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest

      @auth
      <li class="nav-item">
        <a class="nav-link" href="#">投稿する</a>
      </li>
      @endauth

        @auth
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <button class="dropdown-item" type="button"
                      onclick="location.href=''">
              マイページ
              </button>
              <div class="dropdown-divider"></div>

              <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
                <button form="logout-button" class="dropdown-item" type="submit">
                ログアウト
                </button>
              </form>
          </div>
        </li>

        <!-- Dropdown -->
        @endauth

    </ul>
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->