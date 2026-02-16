<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtigoRequest;
use Illuminate\Http\Request;
use App\Models\Artigo;
use Illuminate\Support\Facades\Auth;


class ArtigoController extends Controller
{
    private function onlyAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }
    }


    public function index(Request $request)
    {
       $artigos = Artigo::orderBy('created_at', 'desc')->get();

        if ($request->user()->role === 'admin') {
            return view('admin.artigos.index', compact('artigos'));
        }

        return view('artigos.index', compact('artigos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->onlyAdmin();
        return view('admin.artigos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtigoRequest $request)
    {
        $this->onlyAdmin();
        Artigo::create($request->validated());

        return redirect()->route('artigos.index')->with('success', 'Artigo criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artigo = Artigo::findOrFail($id);
        return view('artigos.show', compact('artigo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->onlyAdmin();
        $artigo = Artigo::findOrFail($id);
        return view('admin.artigos.edit', compact('artigo'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArtigoRequest $request, string $id)
    {
        $this->onlyAdmin();
        $artigo = Artigo::findOrFail($id);
        $artigo->update($request->validated());

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->onlyAdmin();
        $artigo = Artigo::findOrFail($id);
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo deletado com sucesso!');
    }
}
