<?php

namespace App\Contracts;


use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;

interface DocumentRepositoryInterface
{
    public function allDocuments();

    public function showDocument($id);

    public function createDocument(DocumentRequest $request);

    public function updateDocument(DocumentRequest $request, Document $document);

    public function deleteDocument(Document $document);

    public function fetchUserDocuments(Request $request);

    public function fetchDepartmentCategoryDocuments(Request $request);
}
