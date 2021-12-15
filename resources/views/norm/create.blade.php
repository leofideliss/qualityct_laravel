@extends('templates.menuLayout')

@section('script')
    <script src="{{url('assets/js/norm/create.js')}}"></script>
@endsection 

@section('content')
    <div class="container-fluid container-default">

        <div class="row justify-content-start">
            @if ($errors->all())
                <div class="alert alert-danger mt-2" role="alert">
                    @foreach ($errors->all() as $error)

                        {{ $error }}

                    @endforeach
                </div>
            @endif
            <div class="col p-2 ">
                <div class="col-md">
                    <h4>
                        @if (isset($norm)) Editar @else Cadastrar @endif
                        norma
                    </h4>
                </div>
                @if (isset($norm))
                    <form action="{{ route('norm.update', $norm->id) }}" method="POST" id="formEdit" name="formEdit"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('norm.store') }}" method="POST" id="formCad" name="formCad"
                            enctype="multipart/form-data">
                @endif

                @csrf
                <div class="row">

                    <div class="form-group col-md">
                        <label for="name">Norma</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Norma"
                            value="{{ $norm->name ?? old('name') }}">
                    </div>
                </div>
                @php
                    if (isset($norm)) {
                        $segment_search = new App\Models\Segment();
                       
                        $experiment_search = new App\Models\Experiment();
                    
                        $segment_result = $segment_search->find($norm->id_segment);
                       
                        $experiment_result = $experiment_search->find($norm->id_experiment);
                    }
                @endphp
                <div class="row">
                    <div class="form-group col-md">
                        <label for="id_leather_type">Tipo do couro</label>
                        <select name="id_leather_type" id="id_leather_type" class="form-control">
                            <option value=""> --- Selecione ---
                            </option>
                            @foreach ($leathers as $leather)
                                <option value="{{ $leather->id }}">{{ $leather->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="id_segment">Segmento</label>
                        <select name="id_segment" id="id_segment" class="form-control">
                            <option value="{{ $segment_result->id ?? '' }}">
                                {{ $segment_result->name ?? 'Selecione' }}
                            </option>
                            @foreach ($segments as $segment)
                                <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="id_experiment">Experimento</label>
                        <select name="id_experiment" id="id_experiment" class="form-control" disabled>
                          <option value="">--- Selecione ---</option>
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md">
                        <label for="min_value">Condição da norma</label>
                        <input type="text" name="min_value" id="min_value" class="form-control"
                            placeholder="Ex: > 120" value="">
                    </div>
                    <div class="form-group col-md">
                        <label for="id_uni">Parâmetros do valor</label>
                        <select name="id_uni" id="id_uni" class="form-control">
                            <option value="{{ $norm->uni ?? '' }}">{{ $norm->uni ?? 'Selecione' }}</option>
                            @foreach ($measures as $value)
                                <option value="{{$value->id}}">{{$value->uni}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="norm_file">Arquivo</label>
                        <input type="file" name="norm_file" id="norm_file" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class=" col-md-4">
                        <input type="submit" class="btn btn-primary mt-2" name="submit" id="submit" value=" @if (isset($norm)) Editar @else Cadastrar @endif ">
                                    </div>
                                    <div class=" col-md-4 text-end">
                        <a href="{{ route('norm.index') }}" class="btn btn-danger mt-2">Cancelar</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
