<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class ProductController extends Controller
{
    // app/Http/Controllers/ProductController.php

    public function showBestSellingProductsJson()
    {
        // A unique cache key for our data
        $cacheKey = 'best_selling_products_list';

        // Try to get the data from cache, if not found, fetch from DB and store in cache
        // cache for 60 minutes
        $products = Cache::remember($cacheKey, 60 * 60, function () {
            return Product::orderByDesc('sales_count')->take(10)->get();

        });

        return response()->json($products);
    }

}
