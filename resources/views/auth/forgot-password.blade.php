<x-guest-layout>
    <div style="background-image: url('{{ asset('fondologin.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: 100vh;">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Coloque su correo con el cual se registro para enviar el codigo de verificacion') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('Enviar codigo') }}
                        </x-jet-button>
                    </div>
                </form>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>
