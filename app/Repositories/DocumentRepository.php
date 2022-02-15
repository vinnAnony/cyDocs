<?php
namespace App\Repositories;

use App\Contracts\DocumentRepositoryInterface;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function allDocuments()
    {
        return Document::all();
    }

    public function createDocument(DocumentRequest $request)
    {
        return Document::create($request->all());
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

}
