<div>
    <x-dialog-modal wire:model.live="DeleteRolePermissionModal" submit="edit">
        <x-slot name="title" class="text-justify">
            Delete {{ $name }} Role Permission
        </x-slot>

        <x-slot name="content">
            <p>
                Are you sure you want to delete this Role Permission?
                Once deleted, all of its resources and data will be permanently deleted.
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('DeleteRolePermissionModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="deleteRolePermission" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="fa-regular fa-trash-can fa-xl"></i> &ensp;
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>
