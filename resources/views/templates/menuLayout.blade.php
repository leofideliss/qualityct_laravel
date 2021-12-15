@php
use Illuminate\Support\Facades\Auth;
use App\Models\Type_user;
try {
    $current_user = Auth::user();
} catch (\Throwable $th) {
    route('login');
}

@endphp
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/imgs/logoMarrom.png') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/style.css') }}">
    <script src="https://kit.fontawesome.com/e6f96c6a68.js" crossorigin="anonymous"></script>

    <title>QualityCT</title>
</head>

<body>
    <div class="container-fluid h-100">

        <div class="row " style="height:8%;">
            <div class="col-2 menu-cabecalho h-100 ">
                <div class="h-100 d-flex flex-column justify-content-center align-items-center" id="qualityCT">
                    <a href="{{route('home')}}">
                       
                        <h3> <img src="{{url('assets/imgs/logoPequeno2.png')}}" alt=""> QualityCT</h3>
                    </a>

                </div>
            </div>
            <div class="col-10 menu-user h-100"> 

                <div class="row h-100">
                    <div class="col d-flex flex-column justify-content-center align-items-end">
                        <i class="fas fa-user-circle" style="font-size: 25pt"></i>
                    </div>

                    <div class="col-1 d-flex flex-column justify-content-center align-items-start">
                        {{ ucfirst($current_user->login) }}
                    </div>
                </div>

            </div>
        </div>
        <div class="row" style="height: 92%" id="col_menu">
            <div class="col-md-2 menu h-100 g-0 overflow-auto">
                <div class="text-start" >
                    <ul class="list-group">
                        @switch($current_user->id_type_user)
                        @case(1)
                        @include('templates.menuAdmin')
                        @break
                        @case(2)
                        @include('templates.menuDiretor')
                        @break
                        @case(3)
                        @include('templates.menuQuimico')
                        @break

                        @default
                        @endswitch
                    </ul>

                </div>
            </div>
            <div class="col-md-10 h-100">
                @yield('content')
            </div>

        </div>
        
    </div>


    <!-- Adicionando script dinamicamente de acordo com a página-->
    @yield('script')
   
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script> --}}

    <script src="{{url('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/js/menus/menu.js')}}"></script>
    <script src="{{url('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="{{url('assets/js/jquery.mask.js')}}"></script>


</body>

</html>