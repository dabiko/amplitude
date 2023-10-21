<div>

    <x-dialog-modal wire:model.live="UpdatePrivilegeModal" submit="edit">
        <x-slot name="title" class="text-justify">
            UPDATE PRIVILEGE
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.role" value="{{ __('Role Name') }}" />
                    <x-input disabled id="edit_role" wire:model="edit_role" class="mt-1 block w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 " autocomplete="edit_role" />
                    <x-input-error for="edit_role" class="mt-2" />
{{--                    {{ $role }}--}}
                    <div class="mt-5 float-right">
                        <x-secondary-button @click="$wire.set('UpdatePrivilegeModal', false)" wire:loading.attr="disabled">
                            <i class="fa-solid fa-circle-xmark fa-xl"></i> &ensp;
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-button class="ml-3 hover:bg-indigo-700 bg-indigo-500" wire:loading.attr="disabled">
                            <i class="fa-solid fa-hard-drive fa-xl"></i>&ensp;
                            {{ __('Update') }}
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
                    @php
                        $permissions_sub = \App\Models\User::getPermissionByGroupName($group->group_name);
                    @endphp

                    <div wire:key="{{ $group->group_name }}" class="col-span-12 mb-2">
                        <div class="mt-2 mb-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label for="{{$group->group_name}}" class="flex items-center">
                                <input
                                    type="checkbox"
{{--                                    {{ \App\Models\User::roleHasPermissions($role,$permissions) ? "checked" : " " }}--}}
                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                />
                                <span class="ml-2 text-sm capitalize text-gray-600 dark:text-gray-400">{{ $group->group_name }}</span>
                                <x-input-error for="form.group" class="mt-2" />
                            </label>


                            @foreach($permissions_sub as $permission)
                                <label wire:key="{{ $permission->id }}" for="{{$permission->name}}" class="flex items-center">
                                    <x-checkbox
{{--                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}}--}}
                                        wire:model="permissions"
                                        :value="$permission->id"
                                    />
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
            <x-secondary-button @click="$wire.set('UpdatePrivilegeModal', false)" wire:loading.attr="disabled">
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
