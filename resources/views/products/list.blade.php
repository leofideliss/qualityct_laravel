@extends('templates.menuLayout')

@section('script')
    <script src="{{ url('assets/js/products/list.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid container-default">

        <div class="row">

            <div class="col-md mt-2">
                <h4 style="font-weight: bolder">Lista de produtos</h4>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 form-group mb-2">
                <label for="id_client">Cliente</label>
                <select name="id_client" id="id_client" class="form-control">
                    <option value="">--- Selecione ----</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->contact_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="row" id="row_table">
            <div class="col">
                <table class="table" id="table_prod">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Tipo do couro</th>
                            <th>Segmento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
         
        </div>
        <div class="row h-100 justify-content-center" id="spinner">
            <div class="col-md-1 h-100">
                
                    <div class="lds-ring">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
             
            </div>
        </div>



    </div>
@endsection
