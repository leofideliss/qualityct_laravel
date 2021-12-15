@extends('templates.menuLayout')

@section('content')
<div class="container container-default col-6 m-2 p-2">

            <h3>
                @if (isset($type_user)) Editar @else Cadastrar @endif
                Tipo de usuário
            </h3>
            @if (isset($type_user))
            <form action="{{ route('type_user.update',$type_user->id) }}" id="formEdit" name="formEdit" method="POST">
                @method('PUT')
            @else
            <form action="{{ route('type_user.store') }}" id="formCad" name="formCad" method="POST">
                
            @endif
       
                @csrf
                <div class="row">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tipo de usuário" value="{{$type_user->name ?? ''}}">
                    </div>

                </div>
                <div class="row justify-content-between">
                    <div class="col-4 form-group">
                
                        <input type="submit" class="form-control btn-primary mt-2" name="submit" id="submit"
                            value=" @if(isset($type_user)) Editar @else Cadastrar @endif ">
                    </div>
                    <div class="col-3 form-group text-end mt-2">
                        <a class="btn btn-danger" href="{{ route('type_user.index') }}">Cancelar</a>
                    </div>
                </div>
            
            </form>
      

    </div>
@endsection
