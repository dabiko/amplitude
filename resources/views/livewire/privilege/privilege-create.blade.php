<div>
    <x-button @click="$wire.set('CreatePrivilegeModal', true)" class="mt-5 mr-9 mb-5 hover:bg-indigo-700 bg-indigo-500 float-right">
        <i class="fa-solid fa-circle-plus fa-xl"></i>&ensp;
        {{ __('Privilege') }}
    </x-button>

    <x-dialog-modal wire:model.live="CreatePrivilegeModal" submit="save">
        <x-slot name="title" class="text-justify">
            ASSIGN PRIVILEGE
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.role" value="{{ __('Role Name') }}" />
                    <select id="form.role" wire:model="form.role" class="mt-1 block w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 " autocomplete="form.role">
                        <option selected value="">Select role</option>
                        @foreach($roles as $role)
                            <option wire:key="{{ $role->id }}" value="{{ Crypt::encryptString($role->id) }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.role" class="mt-2" />

                    <div class="mt-5 float-right">
                        <x-secondary-button @click="$wire.set('CreatePrivilegeModal', false)" wire:loading.attr="disabled">
                            <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                            <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>

                <div class="col-span-12">
                    <x-label for="privilege" value="{{ __('Privileges') }}" />
                    <div class="mt-2 mb-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center" >
                                <x-checkbox wire:model="CheckAllPrivileges" />
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">All Privilege</span>
                            </label>
                    </div>
                    <hr />
                </div>



                @foreach($permission_groups as $group)
                    <div wire:key="{{ $group->group_name }}" class="col-span-12 mb-2">
                        <div class="mt-2 mb-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label for="{{$group->group_name}}" class="flex items-center">
                                <x-checkbox wire:model="form.group" :value="$group->group_name"/>
                                <span class="ml-2 text-sm capitalize text-gray-600 dark:text-gray-400">{{ $group->group_name }}</span>
                                <x-input-error for="form.group" class="mt-2" />
                            </label>
                            @php
                             $permissions = \App\Models\User::getPermissionByGroupName($group->group_name);
                            @endphp

                            @foreach($permissions as $permission)
                                <label wire:key="{{ $permission->id }}" for="{{$permission->name}}" class="flex items-center">
                                    <x-checkbox
                                        wire:model="form.permissions"
                                        :value="$permission->id"/>
                                    <span class="ml-2 capitalize text-sm text-gray-600 dark:text-gray-400">{{ $permission->name }}</span>
                                    <x-input-error for="form.permissions" class="ml-2" />
                                </label>
                                <br/>
                            @endforeach
                        </div>
                        <hr />
                    </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('CreatePrivilegeModal', false)" wire:loading.attr="disabled">
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
