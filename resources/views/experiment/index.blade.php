@extends('templates.menuLayout')

@section('content')
    <div class="container-fluid border container-default">
        <div class="row justify-content-between mt-4">
            <h4 style="font-weight: bolder">Lista de experimentos</h4>
            <div class="col-4">
                <form method="POST" class="row row-cols-lg-auto g-3 align-items-center"
                    action="{{ route('experiment.search') }}">
                    @csrf
                    <div class="input-group mb-2">
                        <input name="name" id="name" type="text" class="form-control" placeholder="Experimento">
                        <button class="btn btn-outline-secondary" type="submit" id="btn-search"
                            style="background-color:#2A2D34"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-3 text-end">
                <a href="{{ route('experiment.create') }}" style="color: black"><i class="fas fa-plus"
                        style="color: green"></i>
                    Novo experimento</a>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success mt-2">
                {{ session('message') }}
            </div>
        @endif
        @if (session('alert'))
        <div class="alert alert-danger mt-2">
            {{ session('alert') }}
        </div>
    @endif
        <table class="table">
            <thead>
                <tr class="table table-primary">
                    <th>Experimento</th>
                    <th>Tipo do couro</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($experiments as $experiment)
                    @php
                        $leather_type_search = new App\Models\Leather_type();
                        $leather_type = $leather_type_search->find($experiment->id_leather_type);
                    @endphp
                    <tr>
                        <td>{{ $experiment->name }}</td>
                        <td>{{ $leather_type->name }}</td>
                        <td class="text-center in-line">
                            <form method="POST" action="{{ route('experiment.destroy', $experiment->id) }}">
                                {{-- <a href="{{ route('experiment.show', $experiment->id) }}"><i class="fas fa-eye"
                                        style="color: black"></i></a> --}}
                                <a href="{{ url("experiment/$experiment->id/edit") }}"><i class="fas fa-pen"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="button-none"> <i class="fas fa-trash-alt" style="color: red"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $experiments->links() !!}
        </div>
    </div>
@endsection
