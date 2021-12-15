@extends('templates.menuLayout')

@section('content')
    <div class="container-fluid border container-default p-2">
        @if ($errors->all())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mt-1" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif
        @if (session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
        @endif

        <div class="row justify-content-start">
         
                <form method="POST" action="{{route('import.upload')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="client_file">Importar lista de clientes</label>
                        <input type="file" class="form-control" id="client_file" name="client_file">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                </form>

        </div>

    </div>
@endsection
