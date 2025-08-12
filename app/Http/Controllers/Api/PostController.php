<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Log::info('X-API-KEY header: ' . $request->header('X-API-KEY'));

        try {
            if ($request->header('X-API-KEY') !== env('BLOG_API_KEY')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $limit = (int) $request->query('limit', 5);

            $posts = Blog::where('status', 'published')
                ->latest()
                ->take($limit)
                ->get(['id', 'title', 'slug', 'description',  'img', 'created_at'])
                ->map(function ($post) {
                    $post->excerpt = $post->description;
                    $post->image = $post->img;

                    if (!empty($post->image) && !\Illuminate\Support\Str::startsWith($post->image, ['http://', 'https://'])) {
                        $post->image = url('assets/images/blog/' . ltrim($post->image, '/'));

                    }

                    // Check created_at before converting
                    if ($post->created_at instanceof \Illuminate\Support\Carbon) {
                        $post->created_at = $post->created_at->toDateTimeString();
                    } elseif (is_string($post->created_at)) {
                        // already a string, do nothing
                    } else {
                        $post->created_at = null; // fallback
                    }

                    return $post;
                });

            return response()->json($posts);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server Error',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }




}
