<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ProductObserverTest extends TestCase
{
     /**
     * @test
     */
    public function test_it_forgets_the_cache_when_a_product_is_updated(): void
    {
        // Arrange
        // We create a mock of the Cache facade
        Cache::shouldReceive('forget')
            ->once()
            ->with('best_selling_products_list');

        // create a mock product to pass to the observer
        $product = new Product();

        // Act
        // Call the updated method on the observer
        $observer = new ProductObserver();
        $observer->updated($product);

        // Assert
        // The assertion is handled by Cache::shouldReceive()->once()
        // If forget is not called, the test will fail
        $this->assertTrue(true);

    }
}