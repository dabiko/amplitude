<div>
    <div class="flex mb-3 ml-8 mt-5">
        <label>
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                   placeholder="Search" required="">
        </label>

        <div class="flex space-x-3 items-center">
            <label for="status" class="w-40 text-sm font-medium text-gray-700 dark:text-white sm:pl-8"> Status :</label>
            <select id="status" wire:model.live="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    <div class="flex space-x-3">

    </div>
    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @if(count($branches) > 0)
                <table class="table-auto min-w-full divide-y bg-white dark:bg-slate-800 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                              #No
                        </th>
                        <th @click="$wire.sortField('id')" scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            <x-sort :$sortDirection :$sortBy :filed="'id'" /> #ID
                        </th>
                        <th @click="$wire.sortField('name')"  scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            <x-sort :$sortDirection :$sortBy :filed="'name'" /> Name
                        </th>
                        <th @click="$wire.sortField('status')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            <x-sort :$sortDirection :$sortBy :filed="'status'" /> Status
                        </th>
                        <th @click="$wire.sortField('user_id')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            <x-sort :$sortDirection :$sortBy :filed="'user_id'" /> Creator
                        </th>
                        <th @click="$wire.sortField('updated_by')"  scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            <x-sort :$sortDirection :$sortBy :filed="'updated_by'" /> Updated By
                        </th>
                        <th @click="$wire.sortField('created_at')"  scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            <x-sort :$sortDirection :$sortBy :filed="'created_at'" /> Create Date
                        </th>
                        <th @click="$wire.sortField('updated_at')"  scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            <x-sort :$sortDirection :$sortBy :filed="'updated_at'" /> Last Update
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($branches as $key => $branch)
                        <tr wire:key="{{$branch->id}}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <x-button class="px-3 py-1 hover:bg-indigo-700  bg-indigo-500 text-white rounded">
                                    {{ $loop->iteration }}
                                </x-button>
                            </td>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <x-button class="px-3 py-1 hover:bg-indigo-700  bg-indigo-500 text-white rounded">
                                    {{ $branch->id }}
                                </x-button>
                            </td>

                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-700 dark:text-white sm:pl-6">
                                {{ $branch->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{$branch->status === 1 ? 'Active' : 'Inactive'}}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $branch->user->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ empty(!$branch->updated_by) ? $branch->user->name : 'No Updates' }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $branch->created_at }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $branch->updated_at }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                <x-button @click="$dispatch('dispatch-view-branch', {id: '{{ $branch->id }}' })" class="px-3 py-1 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-eye'></i>
                                </x-button> &ensp;

                                <x-button @click="$dispatch('dispatch-edit-branch', { id: '{{ $branch->id }}' })" class="px-3 py-1 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-edit'></i>Edit
                                </x-button>&ensp;

                                <button @click="$dispatch('dispatch-delete-branch', { id: '{{ $branch->id }}', name: '{{$branch->name}}' })" class="px-3 py-1 bg-red-500 hover:bg-red-700  text-white rounded">
                                    <i class='far fa-trash-alt'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <table class="table-auto min-w-full divide-y bg-white dark:bg-slate-800 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl">
                    <thead class="bg-gray-50">
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
                            Status
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Creator
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Updated By
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
                                <strong class="text-yellow-500">Oops No Data Available!!! </strong>
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
                    <label for="per_page" class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                    <select id="per_page" wire:model.live="per_page"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            {{ $branches->onEachSide(1)->links() }}
        </div>
    </div>
</div>
