@props(['model'])

@php
    $route_name = $model . '.store';
@endphp

<x-secondary-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'add-record')">
    Add
</x-secondary-button>

<x-modal name="add-record" focusable>
    <form method="post" action="{{ route($route_name) }}" class="p-6">
        @csrf
        @method('post')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add ' . $model) }}
        </h2>

        @if(Auth::user()->role == 'admin')
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Name') }}
                </label>
                <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Email') }}
                </label>
                <input type="email" name="email" id="email"  class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mt-4">
                <label for="website_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Website') }}
                </label>
                <input type="text" name="website_link" id="website_link"  class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mt-4">
                <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Logo') }}
                </label>
                <input type="file" name="logo" id="logo" accept="image/*" class="text-lg"/>
            </div>

        @elseif(Auth::user()->role == 'user')
            <div class="mt-4">
                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('First Name') }}
                </label>
                <input type="text" name="firstName" id="firstName" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mt-4">
                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Last Name') }}
                </label>
                <input type="text" name="lastName" id="lastName" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mt-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Phone') }}
                </label>
                <input type="text" name="phone" id="phone" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

        @endif




        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button type="submit" class="ms-3">
                {{ __('Add ' . ucfirst($model)) }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
