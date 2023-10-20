<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permission') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:permission-import />

            <x-button wire:click="exportPermissions"  class="mt-5 mr-9 mb-5 hover:bg-indigo-700 bg-indigo-500 float-right">
                <i class="fa-solid fa-download fa-xl"></i>&ensp;
                {{ __('Export') }}
            </x-button>

        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:permission-create />
                <livewire:permission-edit />
                <livewire:permission-view />
                <livewire:permission-delete />
                <livewire:permission-table />
            </div>
        </div>
    </div>
</div>
