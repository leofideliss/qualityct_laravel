<div id="nav-menu">

    <li>
        <div class="sidenav pt-2">
            <a class="dropdown-btn"><i class="fas fa-users"></i>Admin.
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a href=" {{ route('user.create') }}" id="nav-item" class="nav-item">Cadastrar Usuário</a>
                <a href=" {{ route('type_user.create') }}" id="nav-item" class="nav-item">Cadastrar Tipo de usuário</a>
                <a href=" {{ route('user.index') }}" id="nav-item" class="nav-item">Lista de Usuários</a>
                <a href=" {{ route('type_user.index') }}" id="nav-item" class="nav-item">Lista de Tipos de Usuário</a> 
            </div>
        </div>
    </li>
    <hr class="dropdown-divider">
    <li>
        <div class="sidenav pt-2">
            <a class="dropdown-btn"><i class="fas fa-users"></i>Cliente
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a href=" {{ route('client.create') }}" id="nav-item" class="nav-item">Novo Cliente</a>
                <a href=" {{ route('products.dir') }}" id="nav-item" class="nav-item">Novo Produto</a>
                <a href=" {{ route('client.index') }}" id="nav-item" class="nav-item">Lista de clientes</a>
                <a href=" {{ route('products.list') }}" id="nav-item" class="nav-item">Lista de produtos</a>
            </div>
        </div>
    </li>
  
    <hr class="dropdown-divider">
    <li>
        <div class="sidenav">
            <a class="dropdown-btn"><i class="fas fa-flask"></i>Testes
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a class="nav-item" href=" {{ route('test.index') }}" id="nav-item">Testes Disponíveis</a>
                <a class="nav-item" href=" {{ route('sample.create') }}" id="nav-item">Nova Amostra</a>
                <a class="nav-item" href=" {{ route('sample.index') }}" id="nav-item">Lista de amostras</a>
            </div>
        </div>
    </li>
    <hr class="dropdown-divider">
    <li>
        <div class="sidenav">
            <a class="dropdown-btn"><i class="far fa-clipboard"></i>Relatórios
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a class="nav-item" href=" {{ route('test.historic') }}" id="nav-item">Resultados</a>
                <a class="nav-item" href=" {{ route('experiment.index') }}" id="nav-item">Lista de
                    Experimentos</a>
                <a class="nav-item" href=" {{ route('norm.index') }}" id="nav-item">Lista de Normas</a>
                <a class="nav-item" href=" {{ route('specifications.index') }}" id="nav-item">Lista de Esp. Cliente</a>
                <a class="nav-item" href=" {{ route('measure.index') }}" id="nav-item">Lista Uni. de Medidas</a>

            </div>
        </div>
    </li>

    <hr class="dropdown-divider">
    <li>
        <div class="sidenav">
            <a class="dropdown-btn"><i class="fas fa-cog"></i>Parâmetros Cofig.
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container">
                <a class="nav-item" href=" {{ route('experiment.create') }}" id="nav-item">Novo Experimento</a>
                <a class="nav-item" href=" {{ route('norm.create') }}" id="nav-item">Nova Norma</a>
                <a class="nav-item" href=" {{ route('specifications.create') }}" id="nav-item">Nova Esp. do Cliente</a>
                <a class="nav-item" href=" {{ route('measure.create') }}" id="nav-item">Nova Uni. de Medida</a>
            </div>
        </div>
    </li>
    

    <hr class="dropdown-divider">
    <div class="sidenav">
            <a href=" {{ route('logout') }}" id="nav-item" class="nav-item"><i
                    class="fas fa-sign-out-alt"></i>Sair</a>
        </div>




</div>




