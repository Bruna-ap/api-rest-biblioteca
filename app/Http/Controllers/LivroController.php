<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    // GET /api/livros
    public function index()
    {
        $livros = Livro::with(['autor', 'categoria'])->get();

        return response()->json($livros);
    }

    // GET /api/livros/{id}
    public function show($id)
    {
        $livro = Livro::with(['autor', 'categoria'])->find($id);

        if (!$livro) {
            return response()->json([
                'message' => 'Livro não encontrado'
            ], 404);
        }

        return response()->json($livro);
    }

    // POST /api/livros
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|string|max:100',
            'isbn' => 'required|string|max:20',
            'anopublicacao' => 'required|integer',
            'descricao' => 'required|string',
            'paginas' => 'required|integer|min:1',
            'idautor' => 'required|exists:autors,id',
            'idcategoria' => 'required|exists:categorias,id',
        ]);

        $livro = Livro::create($dados);

        return response()->json(
            Livro::with(['autor', 'categoria'])->find($livro->id),
            201
        );
    }

    // PUT /api/livros/{id}
    public function update(Request $request, $id)
    {
        $livro = Livro::find($id);

        if (!$livro) {
            return response()->json([
                'message' => 'Livro não encontrado'
            ], 404);
        }

        $dados = $request->validate([
            'titulo' => 'required|string|max:100',
            'isbn' => 'required|string|max:20',
            'anopublicacao' => 'required|integer',
            'descricao' => 'required|string',
            'paginas' => 'required|integer|min:1',
            'idautor' => 'required|exists:autors,id',
            'idcategoria' => 'required|exists:categorias,id',
        ]);

        $livro->update($dados);

        return response()->json(
            Livro::with(['autor', 'categoria'])->find($livro->id)
        );
    }

    // DELETE /api/livros/{id}
    public function destroy($id)
    {
        $livro = Livro::find($id);

        if (!$livro) {
            return response()->json([
                'message' => 'Livro não encontrado'
            ], 404);
        }

        $livro->delete();

        return response()->json([
            'message' => 'Livro excluído com sucesso'
        ]);
    }
}