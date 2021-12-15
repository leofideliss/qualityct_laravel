@extends('templates.menuLayout')

@section('content')
<a href="{{ url("client/$client->id/products/create") }}"><button class="btn btn-primary m-2">Cadastrar </button> </a>
@endsection