<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function setUpload(Request $request)
    {

        if ($request->file('client_file') != null)
            if ($request->file('client_file')->isValid()) {
                $request->file('client_file')->storeAs('clients','teste');
                return redirect()->route('import.index')->with('message', 'Arquivo adicionado com sucesso!');
            }


        return redirect()->back()->withInput()->withErrors(['Nenhum arquivo selecionado!']);
    }
}
