<?php

namespace Tests\Unit; // Your namespace here. I'm assuming it's Tests\Unit

use App\Jobs\BestSellingProductsEmailJob;
use App\Mail\BestSellingProductsMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase; // This is the crucial line

class BestSellingProductsEmailJobTest extends TestCase
{
    // Use this trait to reset the database after each test method
    use RefreshDatabase;

    // Use this trait to prevent actual emails from being sent
    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /** @test */
    public function test_the_job_sends_an_email_with_the_top_3_best_selling_products_to_all_users()
    {
        // 1. Arrange
        Product::factory(5)->create();
        Product::factory(3)->create(['sales_count' => 500]);
        User::factory(3)->create();

        $bestSellers = Product::orderByDesc('sales_count')->take(3)->get();

        // dd($bestSellers->toArray());

        // 2. Act
        $job = new BestSellingProductsEmailJob();
        $job->handle();
        
        // 3. Assert
        // Verify that the email was sent with the correct mailable class
        Mail::assertSent(BestSellingProductsMail::class, function ($mail) use ($bestSellers) {
            
            // Check the products in the email
            $topProducts = $mail->products;
            $this->assertEquals($bestSellers->pluck('id')->sort()->values(), $topProducts->pluck('id')->sort()->values());
            
            // Check the subject
            $mail->assertHasSubject('Top Best-Selling Products');
            
            return true;
        });

        // We can also assert that an email was sent to each user
        $users = User::all();
        foreach ($users as $user) {
            Mail::assertSent(BestSellingProductsMail::class, function ($mail) use ($user) {
                return $mail->hasTo($user->email);
            });
        }
    }
}