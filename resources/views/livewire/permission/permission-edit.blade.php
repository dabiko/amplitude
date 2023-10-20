<div>
    <x-dialog-modal wire:model.live="UpdatePermissionModal" submit="edit">
        <x-slot name="title" class="text-justify">
            UPDATE PERMISSION
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-label for="form.name" value="{{ __('Permission Name') }}" />
                    <x-input id="form.name" wire:model="form.name" type="text" class="mt-1 block w-full"  autocomplete="form.name" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <x-label for="form.group_name" value="{{ __('Group Name') }}" />
                    <select id="form.group_name" wire:model="form.group_name" class="mt-1 block w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 " autocomplete="form.group_name">
                        <option selected value="">Select group name</option>
                        <option value="branches">Branches</option>
                        <option value="departments">Departments</option>
                        <option value="users">Users</option>
                        <option value="logs">Logs</option>
                        <option value="dashboard">Dashboard</option>
                    </select>
                    <x-input-error for="form.group_name" class="mt-2" />
                </div>

            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.set('UpdatePermissionModal', false)" wire:loading.attr="disabled">
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
