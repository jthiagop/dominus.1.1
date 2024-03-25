<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrganismoFormRequest;
use App\Models\Matriz;
use App\Tenant\ManagerTenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                //data e hora
                $dataAtual = Carbon::now();
                $diaDaSemanaPorExtenso = $dataAtual->format('l');
                $dataPorExtenso = $dataAtual->format('d \d\e F \d\e Y');
                $hora = $dataAtual->format('H:i');

                $matrizes = Matriz::get();

                return view('admin.matriz.index', compact('matrizes', 'dataPorExtenso', 'hora', 'diaDaSemanaPorExtenso'));
    }

    public function list()
    {
        $matrizes = matriz::get();

        return view('admin.matriz.list', compact('matrizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.matriz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOrganismoFormRequest $request)
    {

        $data = $request->all();

        if ($request->hasFile('profile_photo_path') && $request->file('profile_photo_path')->isValid()) {
            $filenameWithExt = $request->file('profile_photo_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_photo_path')->getClientOriginalExtension();
            $name = $filename . '_' . time() . '.' . $extension;
            $data['profile_photo_path'] = $name;

            $upload = $request->profile_photo_path->storeAs('matriz/' . \app(ManagerTenant::class)->getTenant()->uuid . '/matriz', $name);

            if(!$upload){
                return redirect()->back()->with('errors', ['Falha no Upload']);
            }



        $data['natureza'] = 'matriz';

        $matriz = $request->user()->matriz()->create($data);

        return redirect()
            ->route('matriz.list')
            ->withSuccess('Cadastro Realizado com Sucesso!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
