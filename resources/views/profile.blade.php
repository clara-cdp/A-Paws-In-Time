<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-10">
            <div class="profile-window p-4 sm:p-6 shadow">
                <livewire:profile.update-profile-information-form />
            </div>

            <div class="profile-window p-4 sm:p-8">
                <livewire:profile.update-password-form />
            </div>

            <div class="profile-window p-4 sm:p-8">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
