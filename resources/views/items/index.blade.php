@extends('app')

@section('content')
@php

$items = $data;

@endphp
<div class="w-full px-4 py-4 flex flex-wrap">

    <!-- Botón de acción en la parte superior para añadir un nuevo item -->
    <div class="w-full flex justify-end mb-4">
        <button class="bg-green-500 text-white rounded-lg px-4 py-2 hover:bg-green-600">Nuevo</button>
    </div>

    @foreach ($items as $pocket => $itemsInPocket)

        <!-- Mostrar el nombre del bolsillo -->
        <div class="w-full md:w-1/3 p-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-96">
                <h2 class="bg-blue-500 text-lg font-bold text-white p-4">{{ $pocket }}</h2>
                
                <!-- Listado de ítems en este bolsillo -->
                <div class="overflow-y-scroll h-72 p-2">
                    @foreach ($itemsInPocket as $idx => $item)
                    @php
                    //if item has Flags (string), separate them by comma and show as a label
                    $flags = explode(',', $item->Flags);

                    @endphp
                        <div class="flex items-center justify-between border-b border-gray-200 py-2">
                            
                            <!-- Sprite del ítem -->
                            <img src="{{ asset($item->getSprite()) }}" alt="sprite" class="w-12 h-12 rounded shadow-md mr-2">

                            <!-- Información principal del ítem -->
                            <div class="flex-grow">
                                <h3 class="text-gray-700 font-semibold">({{ $item->Id }}) {{ $item->Name }}</h3>
                                <p class="text-gray-500 text-sm">{{ $item->Description }}</p>
                                <p class="text-blue-500 text-sm mt-1">Precio: {{ $item->Price }}</p>
                                <p class="text-blue-500 text-sm mt-1">Flags: 
                                    @foreach ($flags as $flag)
                                        <span class="bg-blue-500 text-white rounded-full px-2 py-1 text-xs font-bold mr-1">{{ $flag }}</span>
                                    @endforeach
                            </div>
                            
                            <!-- Botón de edición -->
                            <a href="{{route('items.show',["IdName"=>$item->IdName ])}}" class="text-blue-500 text-sm hover:underline ml-2">Editar</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
