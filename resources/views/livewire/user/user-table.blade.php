<div wire:poll.visible>
    <div class="flex mb-3 ml-8 mt-5">
        <label>
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                   placeholder="Search" required="">
        </label>
    </div>

    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @if(count($users) > 0)
                <table class="overflow-x-scroll md:table-auto min-w-full divide-y bg-white px-6 py-8 ring-1 ring-slate-900/5 shadow-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    <thead class="bg-gray-60 text-gray-700 dark:text-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <tr>
                        @include('livewire.partials.sortable-th', [
                         'columnName' => 'id',
                         'displayName' => '#No'

                       ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'username',
                          'displayName' => 'Username'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'branch_id',
                          'displayName' => 'Branch'

                        ])
                        @include('livewire.partials.sortable-th', [
                           'columnName' => 'role_id',
                           'displayName' => 'Privilege'

                        ])

                        @include('livewire.partials.sortable-th', [
                           'columnName' => 'status',
                           'displayName' => 'Status'

                         ])

                        @include('livewire.partials.sortable-th', [
                           'columnName' => 'two_factor_confirmed_at',
                           'displayName' => '2FA'

                         ])


                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'password',
                          'displayName' => 'Password'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'situation',
                          'displayName' => 'Situation'

                        ])

                        @include('livewire.partials.sortable-th', [
                         'columnName' => 'email_verified_at',
                         'displayName' => 'Email'

                         ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'created_at',
                          'displayName' => 'Created'

                        ])

                        @include('livewire.partials.sortable-th', [
                          'columnName' => 'updated_at',
                          'displayName' => 'Updated'

                        ])

                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700 dark:text-white">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $key => $user)
                        <tr wire:key.live="{{$user->id}}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <x-button class="px-3 py-1 hover:bg-indigo-700  bg-indigo-500 text-white rounded">
                                    {{ $loop->iteration }}
                                </x-button>
                            </td>

                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-700 dark:text-white sm:pl-6">
                                {{ $user->username }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $user->branch->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $user->role->name }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                @if(Cache::has('user-online' . $user->id) && $user->status == 1)
                                    <span class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fa-regular fa-circle-dot fa-beat-fade"></i>
                                        {{ __('Online') }}
                                    </span>
                                @elseif($user->last_activity < \Carbon\Carbon::now()->addSeconds(10) && $user->status == 1 )
                                    <span class="flex-wrap items-center cursor-pointer hover:bg-yellow-300 rounded-md bg-yellow-200 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                                        <i class="fa-regular fa-circle-dot fa-beat-fade"></i>
                                        {{ __('Inactive') }}
                                    </span>
                                @else
                                    <span class="flex-wrap items-center cursor-pointer hover:bg-yellow-300 rounded-md bg-yellow-200 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        {{ __('Offline') }}
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                @if(empty(!$user->two_factor_confirmed_at))
                                    <span class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                         <i class="fa-solid fa-shield-halved"></i>
                                        {{ __('Yes') }}
                                    </span>
                                @else
                                    <span class="flex-wrap items-center cursor-pointer hover:bg-yellow-300 rounded-md bg-yellow-200 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                                       <i class="fa-solid fa-shield-halved"></i>
                                        {{ __('No') }}
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                @if(Hash::check('password', $user->password))
                                    @if($user->id == Auth::id())
                                        <span @click="$dispatch('dispatch-user-reset-password', { id: '', name: '', email: '' })" class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fa-solid fa-lock-open fa-fade"></i>
                                        {{ __('Default') }}
                                         <i class="fa-solid fa-key fa-fade"></i>
                                    </span>
                                    @else
                                        <span @click="$dispatch('dispatch-user-reset-password', { id: '{{ Crypt::encryptString($user->id )}}', name: '{{ Crypt::encryptString($user->username )}}', email: '{{ Crypt::encryptString($user->email )}}' })" class="flex-wrap items-center cursor-pointer hover:bg-red-300 rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <i class="fa-solid fa-lock-open fa-fade"></i>
                                        {{ __('Default') }}
                                         <i class="fa-solid fa-key fa-fade"></i>
                                    </span>
                                    @endif

                                @else
                                    @if($user->id == Auth::id())
                                        <span @click="$dispatch('dispatch-user-reset-password', { id: '', name: '', email: '' })" class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                      <i class="fa-solid fa-shield-halved"></i>
                                        {{ __('Secured') }}
                                         <i class="fa-solid fa-key"></i>
                                    </span>
                                    @else
                                        <span @click="$dispatch('dispatch-user-reset-password', { id: '{{ Crypt::encryptString($user->id )}}', name: '{{ Crypt::encryptString($user->username )}}', email: '{{ Crypt::encryptString($user->email )}}' })" class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                      <i class="fa-solid fa-shield-halved"></i>
                                        {{ __('Secured') }}
                                         <i class="fa-solid fa-key"></i>
                                    </span>
                                    @endif

                                @endif

                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                @if($user->situation === 1)
                                    @if($user->id == Auth::id())
                                        <span @click="$dispatch('dispatch-update-user-situation', { id: '', name: '', situation: '' })" class="flex-wrap items-center cursor-pointer hover:bg-red-300 rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <i class="fa-solid fa-lock fa-fade"></i>
                                        {{ __('Blocked') }}
                                    </span>
                                    @else
                                        <span @click="$dispatch('dispatch-update-user-situation', { id: '{{ Crypt::encryptString($user->id )}}', name: '{{ Crypt::encryptString($user->username) }}', situation: '{{ Crypt::encryptString($user->situation )}}', })" class="flex-wrap items-center cursor-pointer hover:bg-red-300 rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <i class="fa-solid fa-lock fa-fade"></i>
                                        {{ __('Blocked') }}
                                    </span>
                                    @endif
                                @else
                                    @if($user->id == Auth::id())
                                        <span @click="$dispatch('dispatch-update-user-situation', { id: '', name: '', situation: '' })" class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fa-solid fa-lock-open fa-fade"></i>
                                        {{ __('Active') }}
                                       </span>
                                    @else
                                        <span @click="$dispatch('dispatch-update-user-situation', { id: '{{ Crypt::encryptString($user->id )}}', name: '{{ Crypt::encryptString($user->username) }}', situation: '{{ Crypt::encryptString($user->situation )}}', })" class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fa-solid fa-lock-open fa-fade"></i>
                                        {{ __('Active') }}
                                       </span>
                                    @endif
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                @if(empty($user->email_verified_at))
                                    @if($user->id == Auth::id())
                                        <span @click="$dispatch('dispatch-user-email-verification', { id: '', name: '', email: '' })" class="flex-wrap items-center cursor-pointer hover:bg-red-300 rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <i class="fa-solid fa-envelope-open-text fa-fade"></i>
                                        {{ __('Unverified') }}
                                    </span>
                                    @else
                                        <span @click="$dispatch('dispatch-user-email-verification', { id: '{{ Crypt::encryptString($user->id )}}', name: '{{ Crypt::encryptString($user->username )}}', email: '{{ Crypt::encryptString($user->email )}}' })" class="flex-wrap items-center cursor-pointer hover:bg-red-300 rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <i class="fa-solid fa-envelope-open-text fa-fade"></i>
                                        {{ __('Unverified') }}
                                    </span>
                                    @endif
                                @else
                                    @if($user->id == Auth::id())
                                        <span class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fas fa-user-shield"></i>
                                        {{ __('Verified') }}
                                       </span>
                                    @else
                                        <span class="flex-wrap items-center cursor-pointer hover:bg-green-300 rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <i class="fas fa-user-shield"></i>
                                        {{ __('Verified') }}
                                       </span>
                                    @endif
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $user->created_at }}
                            </td>

                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">
                                {{ $user->updated_at }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">

                                <x-button @click="$dispatch('dispatch-view-user', { id: '{{ Crypt::encryptString($user->id) }}' })" class="px-3 py-3  hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-eye'></i>
                                </x-button> &ensp;

                                <x-button @click="$dispatch('dispatch-edit-user', { id: '{{ $user->id }}' })" class="px-3 py-3 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
                                    <i class='far fa-edit'></i>
                                </x-button>&ensp;
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
                            Username
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
            {{ $users->links() }}
        </div>
    </div>
</div>
