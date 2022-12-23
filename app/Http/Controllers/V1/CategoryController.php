<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', null)->with('children')
            ->paginate(config('todosettings.paginate.task'));

        return response()->apiResult(
            __('messages.method.index', ['name' => __('values.categories')]), [
            'categories' => CategoryResource::collection($categories),
            'links' => CategoryResource::collection($categories)->response()->getData()->links,
            'meta' => CategoryResource::collection($categories)->response()->getData()->meta,
        ]);
    }

    public function store(CategoryRequest $request,Category $category)
    {
        $newCategory = $category->createCategory($request->only('name', 'parent_id'));

        return response()->apiResult(
            __('messages.method.store', ['name' => __('values.category')]),
            ['task' => new CategoryResource($newCategory)]
        );
    }

    public function show(Category $category)
    {
        return response()->apiResult(
            __('messages.method.show', ['name' => __('values.category')]),
            ['category' => new CategoryResource($category)]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete(); //TODO auth, user can delete category

        return response()->apiResult(
            __('messages.method.destroy', ['name' => __('values.category')]),
        );
    }
}
