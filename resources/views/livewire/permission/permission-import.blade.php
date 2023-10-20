<div>
    <x-button @click="$wire.set('ImportPermissionModal', true)" class="mt-5 mr-9 mb-5 hover:bg-indigo-700 bg-indigo-500 float-right">
        <i class="fa-solid fa-file-import fa-xl"></i>&ensp;&ensp;
        {{ __('Import') }}
    </x-button>

    <x-dialog-modal wire:model.live="ImportPermissionModal" submit="save">
        <x-slot name="title" class="text-justify">
            IMPORT PERMISSIONS
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="file" value="{{ __('Permission File') }}" />
                    <x-input id="file" wire:model="file" type="file" class="mt-1 block w-full"  autocomplete="file" />
                    <x-input-error for="file" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('ImportPermissionModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-file-import fa-xl"></i>&ensp;
                {{ __('Import') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
