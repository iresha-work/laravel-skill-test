<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                        @if (session('status_ok') === 'employee-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 3000)"
                                class="alert-success text-sm text-gray-600 dark:text-gray-400 "
                            >{{ __('Employee Created.') }}</p>
                        @endif

                        @if (session('status_fail') === 'employee-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 3000)"
                                class="alert-success text-sm text-gray-600 dark:text-gray-400 "
                            >{{ __('Fail to create employee.') }}</p>
                        @endif
                        <h5 class="card-title">{{ __('Employee Register') }}</h5>
                    <form method="POST" action="{{ route('employee.store') }}" >
                        @csrf

                        <!--First Name -->
                        <div>
                            <x-input-label for="em_first_name" :value="__('First Name')" />
                            <x-text-input id="em_first_name" class="block mt-1 w-full" type="text" name="em_first_name" :value="old('em_first_name')" required autofocus autocomplete="em_first_name" />
                            <x-input-error :messages="$errors->get('em_first_name')" class="mt-2" />
                        </div>

                        <!--Last Name -->
                        <div class="mt-4">
                            <x-input-label for="em_last_name" :value="__('First Name')" />
                            <x-text-input id="em_last_name" class="block mt-1 w-full" type="text" name="em_last_name" :value="old('em_last_name')" required  autocomplete="em_last_name" />
                            <x-input-error :messages="$errors->get('em_last_name')" class="mt-2" />
                        </div>

                        <!--Company Name -->
                        <div class="mt-4">
                            <x-input-label for="em_company" :value="__('Choose Company')" />
                            <select required name="em_company" id="em_company" class="form-control">
                                <option value="">Choose Company</option>
                            @forelse ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @empty
                            @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('em_last_name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="em_email" :value="__('Email')" />
                            <x-text-input id="em_email" class="block mt-1 w-full" type="email" name="em_email" :value="old('em_email')" autocomplete="em_email" />
                            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                        </div>
                        
                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="em_phone" :value="__('Phone')" />
                            <x-text-input id="em_phone" class="block mt-1 w-full" type="text" name="em_phone" :value="old('em_phone')"   autocomplete="em_phone" />
                            <x-input-error :messages="$errors->get('em_phone')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                           <x-primary-button class="ml-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
