<?php
namespace App\Repositories;

use App\Contracts\DocumentRepositoryInterface;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function allDocuments()
    {
        return Document::all();
    }

    public function createDocument(DocumentRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('doc_file');
        $name = '/assets/files/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $data['document_file_path'] = $name;

        //dd(json_encode($data));
        return Document::create($data);
    }

    public function showDocument($id)
    {
        return Document::where('id', '=', $id)->first();
    }

    public function updateDocument(DocumentRequest $request, Document $document)
    {
        return $document->update($request->all());
    }

    public function deleteDocument(Document $document)
    {
        /** @var TYPE_NAME $document */
        return $document->delete($document);
    }

    public function fetchUserDocuments(Request $request)
    {
        $departmentId = $request->query('department_id');
        $roleId = $request->query('role_id');

        return Document::where('department_id', '=', $departmentId)
            ->where('role_id', '<=', $roleId)
            ->with('department')->with('category')->with('creator')->with('accessRole')
            ->get();
    }

    public function fetchDepartmentCategoryDocuments(Request $request)
    {
        $departmentId = $request->query('department_id');
        $categoryId = $request->query('category_id');

        return Document::where('department_id', '=', $departmentId)
            ->where('category_id', '=', $categoryId)
            ->get();
    }
}
