<?php

namespace App\Jobs;

use App\Exports\BeerExport;
use App\Mail\ExportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected array $data,
        protected Authenticatable $user
    ){}
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = now()->format('d-m-y-H-i') . '-export-beers.xlsx';
        Excel::store(new BeerExport($this->data), $fileName, 's3');
        Mail::to($this->user->email)->send(
            new ExportMail($fileName)
        );

       $this->user->exports()->create(['file_name' => $fileName]);
    }
}
