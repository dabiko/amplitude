<div>
    <x-dialog-modal wire:model.live="DeletePermissionModal" submit="edit">
        <x-slot name="title" class="text-justify">
            Delete {{ $name }} permission
        </x-slot>

        <x-slot name="content">
            <p>
                Are you sure you want to delete this Permission?
                Once deleted, all of its resources and data will be permanently deleted.
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('DeletePermissionModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="deletePermission" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="fa-regular fa-trash-can fa-xl"></i> &ensp;
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>
