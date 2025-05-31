<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::all();

        // Error handling
        if ($articles->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        } 

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $articles
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
            'status' => ['required', Rule::in(['published', 'draft'])],
            'users_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $image->store('articles', 'public');

        $article = Article::create([
            'title' => $request->title,
            'image' => $image->hashName(),
            'content' => $request->content,
            'status' => $request->status,
            'users_id' => $request->users_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully created',
            'data' => $article
        ], 201);
    }

    public function show($id) {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $article
        ], 200);
    }


    public function update(Request $request, $id) {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'title' => 'sometimes|required|string',
        'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        'content' => 'sometimes|required|string',
        'status' => ['sometimes', Rule::in(['published', 'draft'])],
        'users_id' => 'sometimes|exists:users,id'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()
        ], 422);
    }

    if ($request->hasFile('image')) {
        \Storage::disk('public')->delete('articles/' . $article->image);
        $image = $request->file('image');
        $image->store('articles', 'public');
        $article->image = $image->hashName();
    }

    $article->update($request->except('image'));

    return response()->json([
        'status' => 'success',
        'message' => 'Data updated successfully',
        'data' => $article
        ], 200);
    }


    public function destroy($id) {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
            'status' => 'error',
            'message' => 'Data not found'
        ], 404);
    }

        \Storage::disk('public')->delete('articles/' . $article->image);
        $article->delete();

        return response()->json([
        'status' => 'success',
        'message' => 'Data deleted successfully'
        ], 200);
    }

}
