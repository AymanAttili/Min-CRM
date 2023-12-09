@props(['record'])

<x-primary-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'edit-record{{ $record->id }}')">
    {{ __('Edit') }}
</x-primary-button>
<x-modal name="edit-record{{$record->id}}" focusable>
    <form method="post" action="{{ route('employee.update', ['employee' => $record]) }}" class="p-6">
        @csrf
        @method('put')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit Employee with ID: ' . $record->id) }}
        </h2>


        <div class="mt-4">
            <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('First Name') }}
            </label>
            <input type="text" name="firstName" id="firstName" value="{{ $record->firstName }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <div class="mt-4">
            <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Last Name') }}
            </label>
            <input type="text" name="lastName" id="lastName" value="{{ $record->lastName }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <div class="mt-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Phone') }}
            </label>
            <input type="text" name="phone" id="phone" value="{{ $record->phone }}" class="mt-1 p-2 border rounded-md w-full" required>
        </div>

       <div class="mt-4">
            <label for="editUser{{ $record->id }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-1">
                {{ __('Edit user info') }}
            </label>


            <input id="editUser" type="checkbox" onclick="userForm{{ $record->id }}.classList.contains('hidden')? userForm{{ $record->id }}.classList.remove('hidden'): userForm{{ $record->id }}.classList.add('hidden'); email.disabled = password.disabled = password_confirmation.disabled = !email.disabled">

            <div id="userForm{{ $record->id }}" name="userForm{{ $record->id }}" class="hidden">
                <div class="mt-4">
                    <label for="email{{ $record->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Email') }}
                    </label>
                    <input type="email" name="email" id="email{{ $record->id }}" class="mt-1 p-2 border rounded-md w-full" value="{{ $record?->user?->email }}" disabled>
                </div>

                <div class="mt-4">
                    <label for="password{{ $record->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Password') }}
                    </label>
                    <input type="password" name="password" id="password{{ $record->id }}" class="mt-1 p-2 border rounded-md w-full " disabled>
                </div>

                <div class="mt-4">
                    <label for="password_confirmation{{ $record->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Confirm Password') }}
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation{{ $record->id }}" class="mt-1 p-2 border rounded-md w-full" disabled>
                </div>
            </div>
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
