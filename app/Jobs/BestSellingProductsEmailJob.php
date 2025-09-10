<?php

namespace App\Jobs;

use App\Mail\BestSellingProductsMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BestSellingProductsEmailJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 1. Fetch the top 3 best-selling products.
        // We order by 'sales_count' in descending order and take the top 3.
        $bestSellers = Product::orderByDesc('sales_count')->take(3)->get();
        
        // dd($bestSellers->toArray());

        // 2. Fetch all users who should receive the email.
        $users = User::all();

        // 3. Loop through each user and send the email.
        foreach ($users as $user) {
            Mail::to($user->email)->send(new BestSellingProductsMail($bestSellers));
        }
    }
}
