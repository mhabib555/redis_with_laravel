<?php

namespace App\Console\Commands;

use App\Jobs\BestSellingProductsEmailJob;
use Illuminate\Console\Command;

class SendBestSellingProductsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-best-selling-products-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email with the best selling products to all users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dispatching job to send best sellers email...');
        BestSellingProductsEmailJob::dispatch();
        $this->info('Job dispatched successfully!');
    }
}
