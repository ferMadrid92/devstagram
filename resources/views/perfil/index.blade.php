@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store' )}}" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="username">
                        Nombre de Usuario
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder=" Tu nuevo nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="imagen">
                        Imagen Perfil
                    </label>
                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png, .heic"
                    />
                </div>

                <div class="mb-5">
                    <div class="flex flex-row-reverse items-center gap-3">
                        <label class="block uppercase text-gray-500 font-bold" for="cambiar_datos">
                            Cambiar datos de acceso
                        </label>
                        <input
                            id="cambiar_datos"
                            name="cambiar_datos"
                            type="checkbox"
                            class="border p-3 rounded-lg h-4"
                            {{ old('cambiar_datos') || $errors->has('email') || $errors->has('password') || $errors->has('new_password') ? 'checked' : '' }}
                        />
                    </div>
                </div>

                <div class="{{ $errors->has('email') || $errors->has('password') || $errors->has('new_password') ? '' : 'hidden' }}" id="datos-acceso-editar">
                    <div class="mb-5">
                        <label class="mb-2 block uppercase text-gray-500 font-bold" for="email">
                            Correo electrónico
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="Nuevo Email de Registro"
                            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                            value="{{old('email')}}"
                        />
                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-5">
                        <label class="mb-2 block uppercase text-gray-500 font-bold" for="password">
                            Contraseña actual
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Coloca tu Contraseña actual"
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        />
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block uppercase text-gray-500 font-bold" for="new_password">
                            Nueva Contraseña
                        </label>
                        <input
                            id="new_password"
                            name="new_password"
                            type="password"
                            placeholder="Elige tu nueva Contraseña"
                            class="border p-3 w-full rounded-lg @error('new_password') border-red-500 @enderror"
                        />
                        @error('new_password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-5">
                        <label class="mb-2 block uppercase text-gray-500 font-bold" for="new_password_confirmation">
                            Repetir Contraseña
                        </label>
                        <input
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            type="password"
                            placeholder="Repite tu nueva Contraseña"
                            class="border p-3 w-full rounded-lg"
                        />
                    </div>
    
                </div>
                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >

            </form>
        </div>
    </div>

@endsection