<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-3 shadow rounded-lg md:col-span-2">
                <form x-data="{
                    billingAddress: {{ json_encode($billingAddress->attributesToArray()) }},
                    shippingAddress: {{ json_encode($shippingAddress->attributesToArray()) }},
                }" action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <h2 class="text-xl font-semibold mb-2">Profile Details</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <x-input
                            type="text"
                            name="first_name"
                            value="{{$customer->first_name}}"
                            placeholder="First Name"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                        <x-input
                            type="text"
                            name="last_name"
                            value="{{$customer->last_name}}"
                            placeholder="Last Name"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <x-input
                            type="text"
                            name="email"
                            value="{{$user->email}}"
                            placeholder="Your Email"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <x-input
                            type="text"
                            name="phone"
                            value="{{$customer->phone}}"
                            placeholder="Your Phone"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>

                    <h2 class="text-xl mt-6 font-semibold mb-2">Billing Address</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input
                                type="text"
                                name="billing_address1"
                                x-model="billingAddress.address1"
                                placeholder="Address 1"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input
                                type="text"
                                name="billing_address2"
                                x-model="billingAddress.address2"
                                placeholder="Address 2"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input
                                type="text"
                                name="billing_city"
                                x-model="billingAddress.city"
                                placeholder="City"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input
                                type="text"
                                name="billing_state"
                                x-model="billingAddress.state"
                                placeholder="State"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <select name="billing_country_code"
                                    class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option
                                        {{$country->code === $billingAddress->country_code ? 'selected' : ''}} value="{{ $country->code }}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input
                                type="text"
                                name="billing_zipcode"
                                value="{{$billingAddress->zipcode}}"
                                placeholder="ZipCode"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>

                    <div class="flex justify-between mt-6 mb-2">
                        <h2 class="text-xl font-semibold">Shipping Address</h2>
                        <label for="sameAsBillingAddress" class="text-gray-700">
                            <input @change="$event.target.checked ? shippingAddress = {...billingAddress} : ''"
                                   id="sameAsBillingAddress" type="checkbox"
                                   class="text-purple-600 focus:ring-purple-600 mr-2"> Same as Billing
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input
                                type="text"
                                name="shipping_address1"
                                x-model="shippingAddress.address1"
                                placeholder="Address 1"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input
                                type="text"
                                name="shipping_address2"
                                x-model="shippingAddress.address2"
                                placeholder="Address 2"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input
                                type="text"
                                name="shipping_city"
                                x-model="shippingAddress.city"
                                placeholder="City"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input
                                type="text"
                                name="shipping_state"
                                x-model="shippingAddress.state"
                                placeholder="State"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <select name="shipping_country_code"
                                    value="{{$shippingAddress->country_code}}"
                                    class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option
                                        {{$country->code === $shippingAddress->country_code ? 'selected' : ''}}  value="{{ $country->code }}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input
                                name="shipping_zipcode"
                                x-model="shippingAddress.zipcode"
                                type="text"
                                placeholder="ZipCode"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>

                    <x-button class="w-full">Update</x-button>
                </form>
            </div>
            <div class="bg-white p-3 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Update Password</h2>
                <div class="mb-3">
                    <x-input
                        type="password"
                        name="old_password"
                        placeholder="Your Current Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <x-input
                        type="password"
                        name="new_password"
                        placeholder="New Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <x-input
                        type="password"
                        name="new_password_repeat"
                        placeholder="Repeat New Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <x-button>Update</x-button>
            </div>
        </div>
    </div>
</x-app-layout>
