<x-app-layout>
    <form
        action=""
        method="post"
        class="w-[400px] mx-auto p-6 my-16"
        x-data="signupForm"
        @submit.prevent="submit"
    >
        <h2 class="text-2xl font-semibold text-center mb-4">Create an account</h2>
        <p class="text-center text-gray-500 mb-3">
            or
            <a
                href="{{ route('login') }}"
                class="text-sm text-purple-700 hover:text-purple-600"
            >login with existing account</a
            >
        </p>
        <div class="mb-4">
            <input
                placeholder="Your name"
                type="text"
                name="name"
                x-model="form.name"
                @input="validateName()"
                class="focus:outline-none  rounded-md w-full"
                :class="errors.name ? errorClasses : (form.name ? successClasses : defaultClasses)"
            />
            <small x-show="errors.name" x-text="errors.name" class="text-red-600"></small>
        </div>
        <div class="mb-4">
            <input
                placeholder="Your Email"
                type="email"
                name="email"
                x-model="form.email"
                @input="validateEmail()"
                class="focus:outline-none  rounded-md w-full"
                :class="errors.email ? errorClasses : (form.email ? successClasses : defaultClasses)"
            />
            <small x-show="errors.email" x-text="errors.email" class="text-red-600"></small>
        </div>
        <div class="mb-4">
            <input
                placeholder="Password"
                type="password"
                name="password"
                x-model="form.password"
                @input="validatePassword()"
                class="border-gray-300 focus:outline-none  rounded-md w-full"
                :class="errors.password ? errorClasses : (form.password ? successClasses : defaultClasses)"
            />
            <small x-show="errors.password" x-text="errors.password" class="text-red-600"></small>
        </div>
        <div class="mb-4">
            <input
                placeholder="Repeat Password"
                type="password"
                name="password"
                x-model="form.password_repeat"
                @input="validatePasswordRepeat()"
                class="border-gray-300 focus:outline-none  rounded-md w-full"
                :class="errors.password_repeat ? errorClasses : (form.password_repeat ? successClasses : defaultClasses)"
            />
            <small x-show="errors.password_repeat" x-text="errors.password_repeat" class="text-red-600"></small>
        </div>

        <button
            class="btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full"
        >
            Signup
        </button>
    </form>
</x-app-layout>
