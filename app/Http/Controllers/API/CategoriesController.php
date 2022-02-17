<?php

namespace App\Http\Controllers\API;

use App\Contracts\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->allCategories();
        return response()->json($categories, 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepo->createCategory($request);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryRepo->showCategory($id);
        return response()->json($category, 200);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepo->updateCategory($request, $category);
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category = $this->categoryRepo->deleteCategory($category);
        return response()->json($category, 200);
    }

    public function fetchCategoryDocuments($id)
    {
        $category = $this->categoryRepo->fetchCategoryDocuments($id);
        return response()->json($category, 200);
    }


    public function fetchDepartmentCategories($id)
    {
        $category = $this->categoryRepo->fetchDepartmentCategories($id);
        return response()->json($category, 200);
    }
}
