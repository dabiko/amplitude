<div>
    <div class="flex mb-3 ml-8 mt-5">
        <label>
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                   placeholder="Search" required="">
        </label>

        <div class="flex space-x-3 items-center">
            <label for="status" class="w-40 text-sm font-medium text-gray-700 dark:text-white sm:pl-8"> Group :</label>
            <select id="status" wire:model.live="group"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">All</option>
                <option value="branches">Branch</option>
                <option value="departments">Department</option>
                <option value="users">Users</option>
                <option value="logs">Logs</option>
                <option value="dashboard">Dashboard</option>
            </select>
        </div>
    </div>

    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @if(count($permissions) > 0)
                <table class="md:table-fixed min-w-full divide-y bg-white px-6 py-8 ring-1 ring-slate-900/5 shadow-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    <thead class="bg-gray-60 text-gray-700 dark:text-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-700 dark:text-white sm:pl-6">
                            #No
                        </th>

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'id',
                          'displayName' => 'ID'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'name',
                          'displayName' => 'Name'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'group_name',
                          'displayName' => 'Group'

                        ])

                        @include('livewire.partials.sortable-th', [
                           'columnName' => 'user_id',
                           'displayName' => 'Creator'

                         ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'updated_by',
                          'displayName' => 'Updater'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'created_at',
                          'displayName' => 'Create Date'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'updated_at',
                          'displayName' => 'Last Update'

                        ])

                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700 dark:text-white">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($permissions as $key => $permission)
                        <tr wire:key.live="{{$permission->id}}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <x-button class="px-3 py-1 hover:bg-indigo-700  bg-indigo-500 text-white rounded">
                                    {{ $loop->iteration }}
                                </x-button>
                            </td>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <x-button class="px-3 py-1 hover:bg-indigo-700  bg-indigo-500 text-white rounded">
                                    {{ $permission->id }}
                                </x-button>
                            </td>

                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-700 dark:text-white sm:pl-6">
                                {{ $permission->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $permission->group_name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $permission->user->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ empty(!$permission->updated_by) ? $permission->user->name : 'No Updates' }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $permission->created_at }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $permission->updated_at }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                <x-button @click="$dispatch('dispatch-view-permission', { id: '{{ $permission->id }}' })" class="px-3 py-1 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-eye'></i>
                                </x-button> &ensp;

                                <x-button @click="$dispatch('dispatch-edit-permission', { id: '{{ $permission->id }}' })" class="px-3 py-1 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-edit'></i>
                                </x-button>&ensp;

                                <button @click="$dispatch('dispatch-delete-permission', { id: '{{ Crypt::encryptString($permission->id) }}', name: '{{$permission->name}}' })" class="px-3 py-1 bg-red-500 hover:bg-red-700  text-white rounded">
                                    <i class='far fa-trash-alt'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <table class="md:table-fixed min-w-full divide-y bg-white px-6 py-8 ring-1 ring-slate-900/5 shadow-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    <thead class="bg-gray-60 text-gray-700 dark:text-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            #No
                        </th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            #ID
                        </th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            Name
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Group Name
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Create Date
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Last Update
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td colspan="100%" style="text-align: center;">
                            <div class="alert py-5 alert-primary text-gray-700 dark:text-white" role="alert">
                                <i data-feather="alert-circle"></i>
                                <strong class="text-indigo-500">Oops No Data Available!!! </strong>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
        <div class="mt-5 mb-2 text-gray-700 dark:text-white">
            <div class="flex">
                <div class="flex space-x-2 items-center mb-3">
                    <label for="per_page" class="w-32 text-sm font-medium text-gray-700 dark:text-white">Per Page</label>
                    <select id="per_page" wire:model.live="per_page"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            {{ $permissions->links() }}
        </div>
    </div>
</div>
