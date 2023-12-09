@props(['record'])

<x-primary-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'edit-record{{ $record->id }}')">
    {{ __('Edit') }}
</x-primary-button>
<x-modal name="edit-record{{$record->id}}" focusable>
    <form method="post" action="{{ route('company.update', ['company' => $record]) }}" class="p-6">
        @csrf
        @method('put')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit Company with ID: ' . $record->id) }}
        </h2>

        <div class="mt-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('name') }}
            </label>
            <input type="text" name="name" id="name" value="{{ $record->name }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>


        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Email') }}
            </label>
            <input type="email" name="email" id="email" value="{{ $record->email }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>


        <div class="mt-4">
            <label for="website_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Website') }}
            </label>
            <input type="text" name="website_link" id="website_link" value="{{ $record->website_link }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button type="submit" class="ms-3">
                {{ __('Save Changes') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
