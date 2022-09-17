<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-3 shadow rounded-lg md:col-span-2">
                <h2 class="text-xl font-semibold mb-2">Profile Details</h2>
                <div class="mb-3">
                    <input
                        type="text"
                        placeholder="Your Name"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        placeholder="Your Email"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <input
                        type="text"
                        placeholder="Your Phone"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>

                <h2 class="text-xl mt-6 font-semibold mb-2">Billing Address</h2>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <input
                            type="text"
                            placeholder="Address 1"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="Address 2"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <input
                            type="text"
                            placeholder="City"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="State"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <select class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                            <option value="">Select Country</option>
                            <option value="ge">Georgia</option>
                            <option value="us">USA</option>
                            <option value="in">India</option>
                            <option value="de">Germany</option>
                        </select>
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="ZipCode"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>

                <div class="flex justify-between mt-6 mb-2">
                    <h2 class="text-xl font-semibold">Shipping Address</h2>
                    <label for="sameAsBillingAddress" class="text-gray-700">
                        <input id="sameAsBillingAddress" type="checkbox"
                               class="text-purple-600 focus:ring-purple-600 mr-2"> Same as Billing
                    </label>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <input
                            type="text"
                            placeholder="Address 1"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="Address 2"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <input
                            type="text"
                            placeholder="City"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="State"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <select class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                            <option value="">Select Country</option>
                            <option value="ge">Georgia</option>
                            <option value="us">USA</option>
                            <option value="in">India</option>
                            <option value="de">Germany</option>
                        </select>
                    </div>
                    <div>
                        <input
                            type="text"
                            placeholder="ZipCode"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                </div>

                <button class="btn-emerald w-full">Update</button>
            </div>
            <div class="bg-white p-3 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Update Password</h2>
                <div class="mb-3">
                    <input
                        type="password"
                        placeholder="Your Current Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <input
                        type="password"
                        placeholder="New Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <div class="mb-3">
                    <input
                        type="password"
                        placeholder="Repeat New Password"
                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                    />
                </div>
                <button class="btn-emerald">Update</button>
            </div>
        </div>
    </div>
</x-app-layout>
