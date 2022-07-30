<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
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
        $this->authorize('viewAny', Category::class);
        $categories =  Category::select('*')->paginate(5);
        return view('backend.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        try {
            $category->save();
            return redirect()->route('categories.index')->with('success','Thêm'. ' ' . $request->name.' '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error','Thêm'. ' ' . $request->name.' '.  'không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $params = [
            'category'=> $category
        ];
        return view('backend.categories.show',$params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $params = [
            'category'=> $category
        ];
        return view('backend.categories.edit',$params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        try {
            $category->save();
            return redirect()->route('categories.index')->with('success','Sửa'. ' ' . $request->name.' '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error','Sửa'. ' ' . $request->name.' '.  'không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success','Xóa danh mục thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error','Xóa'. 'không thành công');
        }

        
        
    }
}
