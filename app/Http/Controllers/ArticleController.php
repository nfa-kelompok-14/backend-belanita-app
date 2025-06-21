<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request) 
    {
        $query = Article::with('user');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $query->orderBy('created_at', 'desc');

        $articles = $query->get();

        if ($articles->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => ArticleResource::collection($articles)
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
            $imagePath =  $path;
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status ?? 'draft',
            'image' => $imagePath,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Article created successfully',
            'data' => $article
        ], 201);
    }

    public function show($slug) {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
        ], 404);
    }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => new ArticleResource($article)
        ], 200);
    }

    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json(['status' => 'error', 'message' => 'Data not found'], 404);
        }

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

        // Hapus gambar lama kalau upload gambar baru
        if ($request->hasFile('image')) {
            if ($article->image && $article->image !== 'article/default.png') {
                $oldPath = str_replace('', '', $article->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('article', $filename, 'public');
            $article->image = '' . $path;
        }

        // Update field-field lain
        if ($request->filled('title')) {
            $article->title = $request->title;
            // Generate slug baru dari title baru
            $article->slug = Str::slug($request->title);
        }
        if ($request->filled('content')) {
            $article->content = $request->content;
        }
        if ($request->filled('status')) {
            $article->status = $request->status;
        }

        $article->save();

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

        if ($article->image && $article->image !== 'article/default.png') {
            $path = str_replace('/', '', $article->image);
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
