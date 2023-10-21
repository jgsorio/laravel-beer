<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Services\ExportService;
use Illuminate\Http\JsonResponse;

class ExportController extends Controller
{
    public function index(): JsonResponse
    {
        $exports = app(ExportService::class)->getAll();
        return response()->json($exports);
    }

    public function destroy(Export $export): void
    {
        app(ExportService::class)->delete($export);
    }
}
