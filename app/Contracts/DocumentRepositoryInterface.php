<?php

namespace App\Contracts;


use App\Http\Requests\DocumentRequest;
use Models\App\Document;

interface DocumentRepositoryInterface
{
    public function allDocuments();

    public function showDocument($id);

    public function createDocument(DocumentRequest $request);

    public function updateDocument(DocumentRequest $request, Document $document);

    public function deleteDocument(Document $document);
}
