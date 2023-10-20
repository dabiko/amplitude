<div>
    <x-button @click="$wire.set('CreateRoleModal', true)" class="mt-5 mr-9 mb-5 hover:bg-indigo-700 bg-indigo-500 float-right">
        <i class="fa-solid fa-circle-plus fa-xl"></i>&ensp;
        {{ __('Role') }}
    </x-button>
    <x-dialog-modal wire:model.live="CreateRoleModal" submit="save">
        <x-slot name="title" class="text-justify">
            ADD A NEW ROLE
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Role Name') }}" />
                    <x-input id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('CreateRoleModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
