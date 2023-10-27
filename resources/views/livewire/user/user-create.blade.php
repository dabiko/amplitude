<div>
    <x-button @click="$wire.set('CreateUserModal', true)" class="mt-5 mr-9 mb-5 hover:bg-indigo-700 bg-indigo-500 float-right">
        <i class="fa-solid fa-circle-plus fa-xl"></i>&ensp;
        {{ __('User') }}
    </x-button>

    <x-dialog-modal wire:model.live="CreateUserModal" submit="save">
        <x-slot name="title" class="text-justify">
            ADD A NEW USER
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
                    <x-label for="form.privilege" value="{{ __('Privilege') }}" />
                    <select id="form.privilege" wire:model="form.privilege" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.privilege">
                        <option selected value="">Select privilege</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.privilege" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.branch" value="{{ __('Branch') }}" />
                    <select id="form.branch" wire:model="form.branch" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.branch">
                        <option selected value="">Select branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.branch" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.department" value="{{ __('Department') }}" />
                    <select id="form.department" wire:model="form.department" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="form.department">
                        <option  selected value="">Select department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.department" class="mt-2" />
                </div>

            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('CreateUserModal', false)" wire:loading.attr="disabled">
                <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
