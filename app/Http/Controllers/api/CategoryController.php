<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $Category = Category::create($request->all());

        return response()->json([
            'message' => 'category stored successfully',
            'category' => new CategoryResource($Category)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if($category){ 
            return response()->json([
                'category' => new CategoryResource($category)
            ]);
        }else{
            return response()->json([
                'error'=> 'category not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);

        if($category){ 
            $category->update($request->all());
            
            return response()->json([
                'message' => 'category updated successfully',
                'category' => new CategoryResource($category)
            ]);
        }else{
            return response()->json([
                'error'=> 'category not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if($category){ 
            $category->delete();
            return response()->json([
                'message' => 'category deleted successfully'
            ]);
        }else{
            return response()->json([
                'error'=> 'category not found'
            ], 404);
        }
    }
}
