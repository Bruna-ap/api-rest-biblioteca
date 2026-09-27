<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // GET /api/categorias
    public function index()
    {
        return response()->json(Categoria::all());
    }

    // GET /api/categorias/{id}
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        return response()->json($categoria);
    }

    // POST /api/categorias
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:45',
            'descricao' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create($dados);

        return response()->json($categoria, 201);
    }

    // PUT /api/categorias/{id}
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:45',
            'descricao' => 'required|string|max:255',
        ]);

        $categoria->update($dados);

        return response()->json($categoria);
    }

    // DELETE /api/categorias/{id}
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        $categoria->delete();

        return response()->json([
            'message' => 'Categoria excluída com sucesso'
        ]);
    }
}