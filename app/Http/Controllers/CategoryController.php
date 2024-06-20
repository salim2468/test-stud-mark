<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $subjects = Subject::all();
        return view('category_index')->with(['categories'=>$categories, 'subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');

        // Save the category
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        return redirect()->route('category.index');

    }
    public function addSubject(Request $request, $categoryId){
        Log::debug('adding' . $categoryId);
        Log::debug($request->checkboxes);
        $category = Category::find($categoryId);
        $category->subjects()->attach($request->checkboxes,['class' => $request->class]);
        
        return redirect()->route('category.index');
    }

    public function getUnselectedSubject($id) {
        $category = Category::with('subjects')->findOrFail($id);
        $existingSubjectIds = $category->subjects->pluck('id');
        $subjects = Subject::whereNotIn('id', $existingSubjectIds)->get();

        return response(['data' => $subjects]);
    }
}
