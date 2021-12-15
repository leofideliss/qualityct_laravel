@extends('templates.menuLayout')

@section('content')
    <div class="container-fluid border container-default ">
        <div class="row justify-content-between mt-4">

            <div class="col-4">
                <h4>Unidades de medida</h4>
            </div>
            <div class="col-2 text-end">
                <a href="{{ route('measure.create') }}" style="color: black"><i class="fas fa-plus"
                        style="color: green"></i>Nova Unidade</a>
            </div>
        </div>
   
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif


    @if (session('delete'))
        <div class="alert alert-danger" role="alert">
            {{ session('delete') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>Código</th>
                        <th>Unidade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($measures as $measure)
                    <tr>
                        <td>{{$measure->id}}</td>
                        <td>{{$measure->uni}}</td>
                        <td class="text-center in-line">
                            <form method="POST" action="{{ route('measure.destroy', $measure->id) }}">
                          @csrf
                                @method('DELETE')
                                <a href="{{route('measure.edit',$measure->id)}}"><i class="fas fa-pen"></i></a>
                            
                                <button class="button-none"> <i class="fas fa-trash-alt"
                                    style="color: red"></i></button>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$measures->links()}}
    </div>
</div>
@endsection
