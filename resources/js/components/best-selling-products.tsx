import { Product } from '@/types/product';
import React, { useState, useEffect } from 'react';

function BestSellingProducts() {
    const [products, setProducts] = useState<Product[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        // Fetch data from the Laravel API endpoint
        fetch('/products/best_selling_products')
            .then(response => response.json())
            .then(data => {
                setProducts(data);
                setLoading(false);
            })
            .catch(error => {
                console.error('Error fetching best sellers:', error);
                setLoading(false);
            });
    }, []); // The empty array ensures this effect runs only once

    if (loading) {
        return <div className="p-4 text-center text-gray-500">Loading best selling products...</div>;
    }

    if (products.length === 0) {
        return <div className="p-4 text-center text-gray-500">No best selling products found.</div>;
    }

    return (
        <div className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mt-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <span className="mr-2">🏆</span> Top 10 Best Selling Products
            </h2>
            <ul className="divide-y divide-gray-200">
                {products.map(product => (
                    <li key={product.id} className="py-3 flex justify-between items-center">
                        <span className="text-gray-700">{product.name}</span>
                        <span className="font-semibold text-indigo-600">
                            {product.sales_count} sales
                        </span>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default BestSellingProducts;
