<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    public function show($id)
    {
        return Blog::find($id);
    }

    public function store(Request $request)
    {
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'body' => $request->body
            ]);

            if ($blog) {
                return Response()->json(['success' => true, 'message' => 'Blog created successfully']);
            }
        } catch (\Throwable $th) {
            return Response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->body = $request->body;
            if ($blog->save())
                return Response()->json([
                    'success' => true,
                    'message' => 'blog updated successfully'
                ]);
            else {
                return Response()->json([
                    'success' => false,
                    'message' => 'blog not updated'
                ]);
            }
        } catch (\Throwable $th) {
            return Response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $blog = Blog::destroy($id);
            if ($blog) {
                return Response()->json([
                    'success' => true,
                    'message' => 'blog deleted successfully'
                ]);
            } else {
                return Response()->json([
                    'success' => false,
                    'message' => 'blog not deleted'
                ]);
            }
            return $blog;
        } catch (\Throwable $th) {
            return Response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
