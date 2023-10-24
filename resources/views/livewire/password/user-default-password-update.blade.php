<div>

    <x-dialog-modal wire:model.live="UpdatePasswordModal" submit="update">
        <x-slot name="title" class="text-justify">
            UPDATE DEFAULT PASSWORD
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="password" value="{{ __('New Password') }}" />
                    <x-input id="password" wire:model="password" type="password" class="mt-1 block w-full"  autocomplete="new-password" />
                    <x-input-error for="password" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" wire:model="password_confirmation" type="password" class="mt-1 block w-full"  autocomplete="new-password" />
                    <x-input-error for="password_confirmation" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                {{ __('Update Password') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>

