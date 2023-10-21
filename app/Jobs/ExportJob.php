<?php

namespace App\Jobs;

use App\Exports\BeerExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected array $data
    ){}
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::store(new BeerExport($this->data), 'export-beers.xlsx', 's3');
    }
}
