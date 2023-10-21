<?php

namespace App\Services;

use App\Jobs\ExportJob;
use Illuminate\Http\Request;

class ExportService
{
    public function export(Request $request): void
    {
        $columns = ['name', 'description', 'tagline', 'first_brewed'];
        $beers = app(PunkApiService::class)->getBeers($request);
        $filteredBeers = collect($beers)->map(function ($beer) use ($columns) {
            return collect($beer)->only($columns)->toArray();
        })->toArray();

        ExportJob::dispatch($filteredBeers);
    }
}
