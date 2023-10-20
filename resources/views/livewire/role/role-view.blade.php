<div>
    <x-dialog-modal wire:model.live="ViewRoleModal" submit="save">
        <x-slot name="title" class="text-justify">
            VIEW ROLE
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Role Name') }}" />
                    <x-input disabled id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('ViewRoleModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>
