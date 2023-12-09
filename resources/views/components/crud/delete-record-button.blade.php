@props(['record', 'model'])

@php
    $route_name = $model . '.destroy';
@endphp
<x-danger-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion{{ $record->id }}')">
    {{ __('Delete') }}
</x-danger-button>
<x-modal name="confirm-deletion{{$record->id}}" focusable>
    <form method="post" action="{{ route($route_name,[$model => $record]) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to delete the ' . $model . ' with id: ' . $record->id . '?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
