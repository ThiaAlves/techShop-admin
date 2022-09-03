

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold">TechShop Admin</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                {{-- ICONE --}}
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Cadastros</h6>
      </li>

      @foreach($menuCadastros as $cadastro)
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('user-profile') ? 'active' : '') }} " href="{{ url($cadastro->link) }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="{{$cadastro->icone}}"></i>
            </div>
            <span class="nav-link-text ms-1">{{$cadastro->nome}}</span>
        </a>
      </li>
      @endforeach


      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Processos</h6>
      </li>
      @foreach($menuProcessos as $processo)
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('user-profile') ? 'active' : '') }} " href="{{ url($processo->link) }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="{{$processo->icone}}"></i>
            </div>
            <span class="nav-link-text ms-1">{{$processo->nome}}</span>
        </a>
      </li>
      @endforeach
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Relatórios</h6>
      </li>
      @foreach($menuRelatorios as $relatorio)
      <li class="nav-item">
        <a class="nav-link {{ (Request::is($relatorio->link) ? 'active' : '') }} " href="{{ url($relatorio->link) }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="{{$relatorio->icone}}"></i>
            </div>
            <span class="nav-link-text ms-1">{{$relatorio->nome}}</span>
        </a>
      </li>
      @endforeach
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configurações de Conta</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('profile') ? 'active' : '') }}" href="{{ url('profile') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user"></i>
          </div>
          <span class="nav-link-text ms-1">Perfil</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          </div>
          <span class="nav-link-text ms-1">Sair</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
