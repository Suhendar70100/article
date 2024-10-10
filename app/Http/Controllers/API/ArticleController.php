<?php

namespace App\Http\Controllers\API;

use Log;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('article.index');
    }

    public function dataTable(): ?JsonResponse
    {
        $data = Article::all();

        return DataTables::of($data)
            ->addColumn('aksi', function ($row) {
                return "<a href='#' data-id='$row->id' class='mdi mdi-eye text-success btn-detail'></a>
                        <a href='#' data-id='$row->id' class='mdi mdi-pencil text-warning btn-edit'></a>
                        <a href='#' data-id='$row->id' class='mdi mdi-trash-can text-primary btn-delete'></a>";
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $data['image'] = url('storage/public/images/' . $imageName);
        }

        $article = Article::create($data);
        return response()->json([
            'message' => 'Tambah Artikel berhasil',
            'data' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        } else {
            return response()->json($article);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::find($id);

        if(!$article){
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($article->image) {
                $oldImageName = basename($article->image);
                Storage::delete('public/images/' . $oldImageName);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $data['image'] = url('storage/public/images/' . $imageName);
        }

        $article->update($data);

        return response()->json([
            'message' => 'Update Artikel berhasil',
            'data' => $article
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if(!$article){
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        if ($article->image) {
            $imageName = basename($article->image);
            Storage::delete('public/images/' . $imageName);
        }

        $article->delete();

        return response()->json([
            'message' => "berhasil Menghapus artikel dengan id : $id",
        ], 200);
    }
}
