<?php

namespace App\Http\Controllers\API;

use App\Contracts\DocumentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentsController extends Controller
{
    protected $documentRepo;

    public function __construct(DocumentRepositoryInterface $documentRepo)
    {
        $this->documentRepo = $documentRepo;
    }

    public function index()
    {
        $documents = $this->documentRepo->allDocuments();
        return response()->json($documents, 200);
    }

    public function store(DocumentRequest $request)
    {
        $document = $this->documentRepo->createDocument($request);

        return response()->json([
            'success' =>true,
            'message' => $document->document_title.' successfully uploaded'
        ], 201);
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

    public function destroy($documentId)
    {
        $response = $this->documentRepo->deleteDocument($documentId);
        if ($response){
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 200);
        }
    }

    public function fetchUserDocuments(Request $request)
    {
        $response = $this->documentRepo->fetchUserDocuments($request);

        return response()->json($response, 201);
    }

    public function fetchDepartmentCategoryDocuments(Request $request)
    {
        $response = $this->documentRepo->fetchDepartmentCategoryDocuments($request);
    }

    public function downloadDocument($documentId)
    {
        $response = $this->documentRepo->downloadDocument($documentId);
        return response()->json($response, 201);
    }
}
