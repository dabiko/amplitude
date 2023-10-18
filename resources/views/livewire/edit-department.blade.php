<div>
    <x-dialog-modal wire:model.live="EditDepartmentModal" submit="edit">
        <x-slot name="title" class="text-justify">
            EDIT DEPARTMENT
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Department Name') }}" />
                    <x-input id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('EditDepartmentModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                {{ __('Update') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
