<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <livewire:user-create />
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:user-view />
                <livewire:user-update-situation />
                <livewire:user-password-update />
                <livewire:user-verification />
                <livewire:user-edit />
                <livewire:user-table />
            </div>
        </div>
    </div>
</div>
