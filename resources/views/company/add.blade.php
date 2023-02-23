<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                        @if (session('status_ok') === 'company-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 3000)"
                                class="alert-success text-sm text-gray-600 dark:text-gray-400 "
                            >{{ __('Company Created.') }}</p>
                        @endif

                        @if (session('status_fail') === 'company-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 3000)"
                                class="alert-success text-sm text-gray-600 dark:text-gray-400 "
                            >{{ __('Fail to create company.') }}</p>
                        @endif
                        <h5 class="card-title">{{ __('Company Register') }}</h5>
                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="company_name" :value="__('Name')" />
                            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="company_name" />
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="company_email" :value="__('Email')" />
                            <x-text-input id="company_email" class="block mt-1 w-full" type="email" name="company_email" :value="old('company_email')" autocomplete="company_email" />
                            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                        </div>

                        <!-- Company logo -->
                        <div class="mt-4">
                            <x-input-label for="company_logo" value="Logo" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="company_logo" name="company_logo" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                "/>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('company_logo')" />
                        </div>

                        <!-- Website -->
                        <div class="mt-4">
                            <x-input-label for="company_web" :value="__('Website')" />
                            <x-text-input id="company_web" class="block mt-1 w-full" type="text" name="company_web" :value="old('company_web')"   autocomplete="company_web" />
                            <x-input-error :messages="$errors->get('company_web')" class="mt-2" />
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
