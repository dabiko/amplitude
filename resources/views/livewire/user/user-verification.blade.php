<div>
    <x-dialog-modal wire:model.live="EmailVerificationModal" submit="">

        <x-slot name="title" class="text-justify">
            {{__('Send a verification email to ')}} {{ $name }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{__('After sending the email, contact the user.')}}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('EmailVerificationModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="sendEmail" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-envelope-open-text fa-xl"></i> &ensp;
                {{ __('Send Verification Email') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
