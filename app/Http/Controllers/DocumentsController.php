<?php

namespace App\Http\Controllers;

use App\Contracts\DocumentRepositoryInterface;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use Models\App\Document;

class DocumentsController extends Controller
{
    protected $documentRepo;

    public function __construct(DocumentRepositoryInterface $documentRepo)
    {
        $this->$documentRepo = $documentRepo;
    }

    public function index()
    {
        $documents = $this->documentRepo->allDocuments();
        return response()->json($documents, 200);
    }

    public function store(DocumentRequest $request)
    {
        $document = $this->documentRepo->createDocument($request);
        return response()->json($document, 201);
    }

    public function show($id)
    {
        $document = $this->documentRepo->showDocument($id);
        return response()->json($document, 200);
    }

    public function update(DocumentRequest $request, Document $document)
    {
        $this->documentRepo->updateDocument($request, $document);
        return response()->json($document, 200);
    }

    public function destroy(Document $document)
    {
        $document = $this->documentRepo->deleteDocument($document);
        return response()->json($document, 200);
    }
}
