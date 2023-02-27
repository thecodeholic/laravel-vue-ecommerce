<x-app-layout>

    <div class="container mx-auto lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-2">Order #{{$order->id}}</h1>
        <div class="bg-white rounded-lg p-3">
            <table>
                <tbody>
                <tr>
                    <td class="font-bold py-1 px-2">Order #</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Date</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Status</td>
                    <td>
                        <span
                            class="text-white py-1 px-2 rounded {{$order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400'}}">
                            {{$order->status}}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">SubTotal</td>
                    <td>${{ $order->total_price }}</td>
                </tr>
                </tbody>
            </table>

            <hr class="my-5"/>

            @foreach($order->items()->with('product')->get() as $item)
                <!-- Order Item -->
                <div class="flex flex-col sm:flex-row items-center  gap-4">
                    <a href="{{ route('product.view', $item->product) }}"
                       class="w-36 h-32 flex items-center justify-center overflow-hidden">
                        <img src="{{$item->product->image}}" class="object-cover" alt=""/>
                    </a>
                    <div class="flex flex-col justify-between">
                        <div class="flex justify-between mb-3">
                            <h3>
                                {{$item->product->title}}
                            </h3>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">Qty: {{$item->quantity}}</div>
                            <span class="text-lg font-semibold"> ${{$item->unit_price}} </span>
                        </div>
                    </div>
                </div>
                <!--/ Order Item -->
                <hr class="my-3"/>
            @endforeach

            @if (!$order->isPaid())
                <form action="{{ route('cart.checkout-order', $order) }}"
                      method="POST">
                    @csrf
                    <button class="btn-primary flex items-center justify-center w-full mt-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                            />
                        </svg>
                        Make a Payment
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
