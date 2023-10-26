<div>
    <x-dialog-modal wire:model.live="BranchStatusModal" submit="">

        <x-slot name="title" class="text-justify">
            {{ $status == 1 ? 'Deactivate' : 'Activate' }} {{ $name }}
        </x-slot>

        <x-slot name="content">
            <p>
                Are you sure about {{ $status == 1 ? 'Deactivating' : 'Activating' }} this branch?
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('BranchStatusModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="updateBranchStatus" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="{{ $status == 1 ? 'fa-solid fa-lock fa-xl fa-fade' : 'fa-solid fa-lock-open fa-xl fa-fade' }}"></i>&ensp;
                {{ $status == 1 ? 'Yes Deactivate' : 'Yes Activate' }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
