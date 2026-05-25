<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNotaRequest;
use App\Models\Nota;

class NotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $notas = Nota::query()

            ->when($search, function ($query, $search) {

                $query->where('titulo', 'ILIKE', "%{$search}%")
                    ->orWhere('contenido', 'ILIKE', "%{$search}%")
                    ->orWhere('categoria', 'ILIKE', "%{$search}%");
            })

            ->orderByDesc('fijada')
            ->latest()
            ->get();

        return view('notas.index', compact('notas'));
    }
    public function create()
    {
        return view('notas.create');
    }
    public function store(StoreNotaRequest $request)
    {
        Nota::create($request->validated());
        return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.');
    }
    public function show(Nota $nota)
    {
        return view('notas.show', compact('nota'));
    }
    public function edit(Nota $nota)
    {
        return view('notas.edit', compact('nota'));
    }
    public function update(StoreNotaRequest $request, Nota $nota)
    {
        $nota->update($request->validated());
        return redirect()->route('notas.index')->with('success', 'Nota actualizada exitosamente.');
    }
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota eliminada exitosamente.');
    }
    public function toggleFijada(Nota $nota)
    {
        $nota->fijada = !$nota->fijada;
        $nota->save();
        return redirect()->route('notas.index')->with('success', 'Estado de fijada actualizado exitosamente.');
    }
    public function categoria($categoria)
    {
        $notas = Nota::where('categoria', $categoria)
            ->latest()
            ->get();

        return view('notas.index', compact('notas'));
    }
}
