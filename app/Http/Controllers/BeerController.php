<?php

namespace App\Http\Controllers;

use App\Services\ExportService;
use App\Services\PunkApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $beers = app(PunkApiService::class)->getBeers($request);
        return response()->json($beers);
    }

    public function export(Request $request): string
    {
        app(ExportService::class)->export($request);
        return response()->json(['Solicitação enviada com sucesso!']);
    }
}
