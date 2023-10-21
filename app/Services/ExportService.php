<?php

namespace App\Services;

use App\Jobs\ExportJob;
use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ExportService
{
    public function export(Request $request): void
    {
        $columns = ['name', 'description', 'tagline', 'first_brewed'];
        $beers = app(PunkApiService::class)->getBeers($request);
        $filteredBeers = collect($beers)->map(function ($beer) use ($columns) {
            return collect($beer)->only($columns)->toArray();
        })->toArray();

        ExportJob::dispatch($filteredBeers, auth()->user());
    }

    public function getAll(): LengthAwarePaginator
    {
        return Export::query()->paginate(10);
    }

    public function delete(Export $export): void
    {
        Storage::delete($export->file_name);
        $export->delete();
    }
}
