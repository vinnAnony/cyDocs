<?php
namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\DocumentRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\DocumentRequest;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function allCategories()
    {
        return Category::with('department')->get();
    }

    public function showCategory($id)
    {
        return Category::where('id', '=', $id)->first();
    }

    public function createCategory(CategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        return $category->update($request->all());
    }

    public function deleteCategory(Category $category)
    {
        /** @var TYPE_NAME $category */
        return $category->delete($category);
    }

    public function fetchCategoryDocuments($id)
    {
        return Category::where('id', $id)->with('documents')->get();
    }

    public function fetchDepartmentCategories($id)
    {
        return Category::where('department_id', $id)->get();
    }
}
