

                 
<div id="nav-menu">

    <li>
        <div class="sidenav pt-2">
            <a class="dropdown-btn"><i class="far fa-clipboard"></i>Relatórios
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a class="nav-item" href=" {{ route('test.historicDir') }}" id="nav-item">Resultados</a>
     
            </div>
        </div>
    </li>

    <hr class="dropdown-divider">
    <div class="sidenav">
            <a href=" {{ route('logout') }}" id="nav-item" class="nav-item"><i
                    class="fas fa-sign-out-alt"></i>Sair</a>
        </div>

</div>