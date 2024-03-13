<div>
    <div class="shadow bg-white p-5 mb-5 rounded">
        <p class="text-xl font-bold text-center mb-4">Comentarios</p>
        @auth

        @if (session('mensaje'))
            <div id="mensaje" class="bg-green-500 p-2 rounded-lg mb-6">
                <p class="text-white text-center uppercase font-bold">{{session('mensaje')}}</p>
            </div>
        @endif

        <form>
            <div class="mb-5">
                <label class="mb-2 block uppercase text-gray-500 font-bold" for="comentario">
                    Agrega un nuevo Comentario
                </label>
                <textarea
                    wire:model="comentario"
                    wire:keydown.enter="store()"
                    id="comentario"
                    name="comentario"
                    placeholder="Agrega un Comentario"
                    class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                ></textarea>
                @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <button
                wire:click="store"
                type="button"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            >{{ !$commentId ? 'Comentar' : 'Guardar' }}</button>
        </form>

        @endauth

        <div class="bg-white shadow mb-5 max-h-96 overflow-auto hover:overflow-y-scroll mt-10">
            @if ($post->comentarios->count())
                @foreach ( $post->comentarios as $comentario)
                    <div class="p-5 border-gray-300 border-b">
                        <div class="flex justify-between">
                            <div>
                                <a href="{{route('posts.index', $comentario->user)}}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="flex gap-3">
                                @if ($comentario->user_id == auth()->user()->id)
                            
                                    <button type="button" wire:click="edit({{$comentario->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(75 85 99)" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                    <button type="button" wire:click="delete({{$comentario->id}})" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(239 68 68)" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>                                  
                                </button>                            
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="p-10 text-center">No hay comentarios aún</p>
            @endif
        </div>
    </div>
</div>
