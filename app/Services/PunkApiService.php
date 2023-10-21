<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PunkApiService
{
    public function getBeers(Request $request): array
    {
        $params = array_filter($request->all(), fn ($param) => $param != 'null' ? $param : null);

        return Http::punkapi()
            ->get('beers', $params)
            ->throw()
            ->json();
    }
}
