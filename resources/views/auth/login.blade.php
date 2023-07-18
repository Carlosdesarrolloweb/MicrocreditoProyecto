  <x-guest-layout >
    <head>

    </head>
    <div style="background-image: url('{{ asset('fondologin.jpg') }}');
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
                height: 100vh;">
        <!-- tu formulario de inicio de sesión aquí -->
        <x-jet-authentication-card style="background-color: #df1313;">
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label for="Nombre_usuario" value="{{ __('Usuarios') }}" />
                    <x-jet-input maxlength="15" id="Nombre_usuario" class="block mt-1 w-full" type="text" name="Nombre_usuario" :value="old('Nombre_usuario')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                    <x-jet-input maxlength="20" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recordar Usuario') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Olvido la Contraseña?') }}
                        </a>
                    @endif

                    <x-jet-button class="ml-4">
                        {{ __('INGRESAR') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </div>

</x-guest-layout>


