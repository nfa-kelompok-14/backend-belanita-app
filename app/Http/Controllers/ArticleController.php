<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::all();

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $imagePath = 'article/default.png';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('article', $filename, 'public');
            $imagePath = 'storage/' . $path;
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Article created successfully',
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

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:draft,published',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('image')) {
            if ($article->image && $article->image !== 'storage/article/default.png') {
                $oldPath = str_replace('storage/', '', $article->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('article', $filename, 'public');
            $article->image = 'storage/' . $path;
        }

        $article->update($request->only(['title', 'content', 'status']));

        return response()->json([
            'status' => 'success',
            'message' => 'Article updated successfully',
            'data' => $article
        ], 200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['status' => 'error', 'message' => 'Data not found'], 404);
        }

        if ($article->image && $article->image !== 'storage/article/default.png') {
            $path = str_replace('storage/', '', $article->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted successfully'
        ], 200);
    }

}
