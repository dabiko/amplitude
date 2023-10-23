<div>
    <x-dialog-modal wire:model.live="UpdateSituationModal" submit="">

        <x-slot name="title" class="text-justify">
            {{ $situation == 0 ? 'Block' : 'Unblock' }} {{ $name }}'s Account
        </x-slot>

        <x-slot name="content">
            <p>
                Are you sure about {{ $situation == 0 ? 'Blocking' : 'Unblocking' }} this Account?
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('UpdateSituationModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="updateUserSituation" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="{{ $situation == 0 ? 'fa-solid fa-lock fa-xl fa-fade' : 'fa-solid fa-lock-open fa-xl fa-fade' }}"></i>&ensp;
                {{ $situation == 0 ? 'Yes Block' : 'Yes Unblock' }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
