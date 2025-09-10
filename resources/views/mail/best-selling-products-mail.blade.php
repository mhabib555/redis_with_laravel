<x-mail::message>
Top Best-Selling Products!
Hello there,
Here is a list of our best-selling products this week. We thought you'd like to see what's popular!

<x-mail::panel>

@foreach ($products as $product)
{{ $product->name }}
Price: ${{ number_format($product->price, 2) }}
Units Sold: {{ number_format($product->sales_count) }}
@endforeach

</x-mail::panel>

<x-mail::button :url="url('/products')">
View All Products
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
