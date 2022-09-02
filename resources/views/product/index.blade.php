<x-app-layout>
    <div
        class="grid gap-8 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-5"
    >
        @foreach($products as $product)
            <!-- Product Item -->
            <div
                x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product)
                ]) }})"
                class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white"
            >
                <a href="{{ route('product.view', $product->slug) }}" class="aspect-w-3 aspect-h-2 block overflow-hidden">
                    <img
                        src="{{ $product->image }}"
                        alt=""
                        class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform"
                    />
                </a>
                <div class="p-4">
                    <h3 class="text-lg">
                        <a href="{{ route('product.view', $product->slug) }}">
                            {{$product->title}}
                        </a>
                    </h3>
                    <h5 class="font-bold">${{$product->price}}</h5>
                </div>
                <div class="flex justify-between py-3 px-4">
                    <button
                        @click="addToWatchlist()"
                        class="w-10 h-10 rounded-full border border-1 border-purple-600 text-purple-600 flex items-center justify-center hover:bg-purple-600 hover:text-white active:bg-purple-800 transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                        </svg>
                    </button>
                    <button class="btn-primary" @click="addToCart()">
                        Add to Cart
                    </button>
                </div>
            </div>
            <!--/ Product Item -->
        @endforeach
    </div>
    {{$products->links()}}
</x-app-layout>
