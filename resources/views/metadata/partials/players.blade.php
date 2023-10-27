<div class="w-full px-4 py-2 flex flex-wrap">
   @foreach ($data['players'] as $idx => $player)
       <div class="w-1/2 p-2">
           <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
               <!-- Barra azul con ID y nombre del jugador -->
               <div class="bg-blue-500 p-2 flex justify-between items-center">
                   <span class="text-sm text-white">ID: ({{ $idx }}) {{ $player->id }}</span>
                   <span class="font-bold text-lg text-white">{{ $player->TrainerType }}</span>
               </div>
               
               <div class="p-4">
                   <!-- Sprite principal -->
                   <div class="mb-4 flex justify-center">
                       <img src="{{ asset($player->getSprite()) }}" alt="sprite" class="w-24 h-24 rounded-full shadow-md border-2 border-blue-500">
                   </div>

                   <!-- Sprites alineados y responsivos -->
                   <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                       <div class="flex flex-col items-center">
                           <span class="text-green-500 mb-2">Andar</span>
                           <img src="{{ asset('graphics/characters/' . $player->DefaultCharset . '.png') }}" alt="sprite" class="w-24 rounded shadow-md" />
                       </div>
                       <div class="flex flex-col items-center">
                           <span class="text-blue-500 mb-2">Bici</span>
                           <img src="{{ asset('graphics/characters/' . $player->WalkCharset . '.png') }}" alt="sprite" class="w-24 rounded shadow-md" />
                       </div>
                       <div class="flex flex-col items-center">
                           <span class="text-purple-500 mb-2">Surf</span>
                           <img src="{{ asset('graphics/characters/' . $player->SurfCharset . '.png') }}" alt="sprite" class="w-24 rounded shadow-md" />
                       </div>
                       <div class="flex flex-col items-center">
                           <span class="text-orange-500 mb-2">Pescar</span>
                           <img src="{{ asset('graphics/characters/' . $player->FishCharset . '.png') }}" alt="sprite" class="w-24 rounded shadow-md" />
                       </div>
                   </div>
               </div>
           </div>
       </div>
   @endforeach
</div>
