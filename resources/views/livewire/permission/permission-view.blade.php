<div>
    <x-dialog-modal wire:model.live="ViewPermissionModal" submit="save">
        <x-slot name="title" class="text-justify">
            VIEW PERMISSION
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Permission Name') }}" />
                    <x-input disabled id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <div class="col-span-12">
                        <x-label for="form.group_name" value="{{ __('Group Name') }}" />
                        <x-input disabled id="form.group_name" wire:model="form.group_name" type="text" class="mt-1 block w-full"  autocomplete="form.group_name" />
                        <x-input-error for="form.group_name" class="mt-2" />
                    </div>
                    <x-input-error for="form.group_name" class="mt-2" />
                </div>

            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('ViewPermissionModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>
