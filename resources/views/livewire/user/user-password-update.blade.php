<div>
    <x-dialog-modal wire:model.live="ResetPasswordModal" submit="">

        <x-slot name="title" class="text-justify">
            {{__('Email Password Reset Link To')}} {{ $name }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{ __('Forgot password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('ResetPasswordModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="sendEmail" class="ml-3 hover:bg-red-700 bg-red-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-envelope-open-text fa-xl"></i> &ensp;
                {{ __('Email Password Reset Link') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
