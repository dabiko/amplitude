<div>

    <x-dialog-modal wire:model.live="ViewUserModal" submit="save">
        <x-slot name="title" class="text-justify">
            View Profile
        </x-slot>

        <x-slot name="content">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4 mb-3">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model.live="photo"
                           x-ref="photo"
                           x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <x-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2 align-center" x-show="! photoPreview">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover">
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input disabled id="name" wire:model="name" type="text" class="mt-1 block w-full"  autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="username" value="{{ __('Username') }}" />
                    <x-input disabled id="username" wire:model="username" type="text" class="mt-1 block w-full"  autocomplete="username" />
                    <x-input-error for="username" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input disabled id="email" wire:model="email" type="text" class="mt-1 block w-full"  autocomplete="email" />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="role" value="{{ __('Role') }}" />
                    <x-input disabled id="role" wire:model="role" type="text" class="mt-1 block w-full"  autocomplete="role" />
                    <x-input-error for="role" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="branch" value="{{ __('Branch') }}" />
                    <x-input disabled id="branch" wire:model="branch" type="text" class="mt-1 block w-full"  autocomplete="branch" />
                    <x-input-error for="branch" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="department" value="{{ __('Department') }}" />
                    <x-input disabled id="department" wire:model="department" type="text" class="mt-1 block w-full"  autocomplete="department" />
                    <x-input-error for="department" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="email_verified" value="{{ __('Verified At') }}" />
                    <x-input disabled id="email_verified" wire:model="email_verified" type="text" class="mt-1 block w-full"  autocomplete="email_verified" />
                    <x-input-error for="email_verified" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="created_at" value="{{ __('Created At') }}" />
                    <x-input disabled id="created_at" wire:model="created_at" type="text" class="mt-1 block w-full"  autocomplete="created_at" />
                    <x-input-error for="created_at" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="updated_at" value="{{ __('Updated At') }}" />
                    <x-input disabled id="updated_at" wire:model="updated_at" type="text" class="mt-1 block w-full"  autocomplete="updated_at" />
                    <x-input-error for="updated_at" class="mt-2" />
                </div>

            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('ViewUserModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>

