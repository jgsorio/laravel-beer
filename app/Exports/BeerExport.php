<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BeerExport implements FromCollection, WithHeadings
{
    public function __construct(
        private array $reportData
    ){}

    public function headings(): array
    {
        return [
            'Name', 'TagLine', 'First Brewed', 'Description'
        ];
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return collect($this->reportData);
    }
}
