@props(['id' => null, 'maxWidth' => null, 'submit' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    @if($submit) <form wire:submit="{{ $submit }}"> @endif
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $title }}
            </div>

            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                {{ $content }}
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-right">
            {{ $footer }}
        </div>
        @if($submit) </form> @endif
</x-modal>