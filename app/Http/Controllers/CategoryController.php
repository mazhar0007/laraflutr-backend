<?php

namespace App\Http\Controllers;

use App\Models\Lookups\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Lookups\CategoryCollection;
use App\Http\Resources\Lookups\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validation->fails()) {
            # code...
            return response(['errors' => $validation->errors()], 422);
        }

        return Category::create($request->all());

    }

    /**
     * Display the specified resource.
     * Here is how inject property is used without passing $id
     * Dependency injection (Auto Inject feature) used here
     * @param  \App\Models\Lookups\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookups\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function edit(Category $category)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lookups\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validation->fails()) {
            # code...
            return response(['errors' => $validation->errors()], 422);
        }

        $category->update($request->all());

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookups\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        return "Category deleted successfully.";
    }
}
