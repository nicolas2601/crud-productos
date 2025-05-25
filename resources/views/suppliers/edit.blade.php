<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Editar Proveedor') }}
            </h2>
            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-forest-dark/50 text-sky-light overflow-hidden shadow-2xl sm:rounded-lg border border-forest-dark/80 animate-fade-in-up">
                <div class="p-8">
                    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-slide-in-left">
                            <!-- Nombre -->
                            <div>
                                <x-label for="name" value="{{ __('Nombre') }}" class="text-gray-300" />
                                <x-input id="name" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="text" name="name" :value="old('name', $supplier->name)" required autofocus />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre de Contacto -->
                            <div>
                                <x-label for="contact_name" value="{{ __('Nombre de Contacto') }}" class="text-gray-300" />
                                <x-input id="contact_name" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="text" name="contact_name" :value="old('contact_name', $supplier->contact_name)" />
                                @error('contact_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <x-label for="email" value="{{ __('Email') }}" class="text-gray-300" />
                                <x-input id="email" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="email" name="email" :value="old('email', $supplier->email)" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <x-label for="phone" value="{{ __('Teléfono') }}" class="text-gray-300" />
                                <x-input id="phone" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="text" name="phone" :value="old('phone', $supplier->phone)" />
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="md:col-span-2">
                                <x-label for="address" value="{{ __('Dirección') }}" class="text-gray-300" />
                                <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address', $supplier->address) }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-button class="ml-4">
                                {{ __('Actualizar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>