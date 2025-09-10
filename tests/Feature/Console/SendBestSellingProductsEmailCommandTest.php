<?php

use App\Jobs\BestSellingProductsEmailJob;
use Illuminate\Support\Facades\Queue;

// Mock the queue to prevent actual job execution during tests
beforeEach(fn () => Queue::fake());

test('the command dispatches the best selling products email job', function () {
    // 1. Arrange: No complex setup needed.
    
    // 2. Act: We call the artisan command.
    $this->artisan('app:send-best-selling-products-email');
    
    // 3. Assert: We verify that the job was pushed.
    Queue::assertPushed(BestSellingProductsEmailJob::class);
});