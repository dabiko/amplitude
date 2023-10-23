<div>
    <x-dialog-modal wire:model.live="EditUserModal" submit="edit">
        <x-slot name="title" class="text-justify capitalize">
            EDIT USER
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Name') }}" />
                    <x-input id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.username" value="{{ __('Username') }}" />
                    <x-input id="form.username" wire:model="form.username" type="text" class="mt-1 block w-full"  autocomplete="form.username" />
                    <x-input-error for="form.username" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.email" value="{{ __('Email') }}" />
                    <x-input id="form.email" wire:model="form.email" type="text" class="mt-1 block w-full"  autocomplete="form.email" />
                    <x-input-error for="form.email" class="mt-2" />
                </div>
                <div class="col-span-12">
                    <x-label for="privilege" value="{{ __('Privilege') }}" />
                    <select name="form.privilege" id="form.privilege" wire:model="form.privilege" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.privilege">
                        @foreach($roles as $role)
                            <option value="{{ Crypt::encryptString($role->id) }}">{{ $role->name }} </option>
                        @endforeach
                    </select>
                    <x-input-error for="form.privilege" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.branch" value="{{ __('Branch') }}" />
                    <select id="form.branch" wire:model="form.branch" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.branch">
                        @foreach($branches as $branch)
                            <option  value="{{ Crypt::encryptString($branch->id) }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.branch" class="mt-2" />
                </div>
                <p class="capitalize"></p>
                <div class="col-span-12">
                    <x-label for="form.department" value="{{ __('Department') }}" />
                    <select id="form.department" wire:model="form.department" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.department">
                        @foreach($departments as $department)
                            <option value="{{ Crypt::encryptString($department->id) }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.department" class="mt-2" />
                </div>

            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('EditUserModal', false)" wire:loading.attr="disabled">
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
