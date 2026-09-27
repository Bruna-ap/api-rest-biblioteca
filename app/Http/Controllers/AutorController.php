<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // GET /api/autores
    public function index()
    {
        return response()->json(Autor::all());
    }

    // GET /api/autores/{id}
    public function show($id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json([
                'message' => 'Autor não encontrado'
            ], 404);
        }

        return response()->json($autor);
    }

    // POST /api/autores
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:45',
            'nacionalidade' => 'required|string|max:45',
            'nascimento' => 'required|date',
            'biografia' => 'required|string',
        ]);

        $autor = Autor::create($dados);

        return response()->json($autor, 201);
    }

    // PUT /api/autores/{id}
    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json([
                'message' => 'Autor não encontrado'
            ], 404);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:45',
            'nacionalidade' => 'required|string|max:45',
            'nascimento' => 'required|date',
            'biografia' => 'required|string',
        ]);

        $autor->update($dados);

        return response()->json($autor);
    }

    // DELETE /api/autores/{id}
    public function destroy($id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json([
                'message' => 'Autor não encontrado'
            ], 404);
        }

        $autor->delete();

        return response()->json([
            'message' => 'Autor excluído com sucesso'
        ]);
    }
}