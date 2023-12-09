@php use function MongoDB\BSON\toJSON; @endphp
@props(['records', 'model'])



<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 dark:text-gray-200 leading-tight w-full" style="font-size: 22px">

            @auth
                @if(Auth::user()->role == 'user' && Auth::user()->employee)
                    <div class="flex justify-between items-center w-full">
                        <div class="grid gap-4">
                            <p style="font-size: 26px">
                                {{ __(Auth::user()->employee->company->name.' Company Admin') }}
                            </p>
                            <p class="text-lg">
                                Company email: <span
                                    class="text-red-600">{{ __(Auth::user()->employee->company->email) }}</span>
                            </p>
                            <p class="text-lg">
                                Company website: <span
                                    class="text-red-600">{{ __(Auth::user()->employee->company->website_link) }}</span>
                            </p>

                        </div>
                        <form method="post" action="{{ route('company.update', Auth::user()->employee->company) }}"
                              enctype="multipart/form-data" class="text-xs flex flex-col items-center">
                            @csrf
                            @method('put') <!-- Assuming you're using the 'put' method for updating -->

                            <!-- Label for Triggering File Input -->
                            <label for="logo" x-data="{ showInput: false }" x-on:click="showInput = true">
                                <!-- Current Logo -->
                                <img src="{{ asset('storage/' . Auth::user()->employee->company->logo) }}"
                                     alt="Current Logo" width="100" height="100">

                                <!-- Hidden Input -->
                                <input type="file" name="logo" id="logo" accept="image/*" class="hidden"
                                       x-show="showInput" x-on:change="showInput = false">
                            </label>

                            <!-- Other Form Fields and Buttons -->
                            <div>
                                <button type="submit" class="rounded-full bg-gray-800 text-white p-2 text-sm">Update
                                    Logo
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    {{ __('MinCRM Admin') }}
                @endif

            @endauth

            @guest
                {{ __('MinCRM') }}
            @endguest

        </div>

    </x-slot>

    <x-table :records="$records->items()" :model="$model"/>
    <div class="w-3/4 text-center mx-auto ">
        {{ $records->links() }}
    </div>
</x-app-layout>
