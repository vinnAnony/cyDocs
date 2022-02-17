<?php

namespace App\Contracts;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function allCategories();

    public function showCategory($id);

    public function fetchCategoryDocuments($id);

    public function fetchDepartmentCategories($id);

    public function createCategory(CategoryRequest $request);

    public function updateCategory(CategoryRequest $request, Category $category);

    public function deleteCategory(Category $category);
}
