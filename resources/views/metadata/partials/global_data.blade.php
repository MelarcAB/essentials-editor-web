<div class="w-full px-4 py-2">
   <!-- Asumiendo que $data['globalData'] contiene los datos globales -->
   @if(isset($data['globalData']))
       <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
           <!-- Barra azul con título de los datos globales -->
           <div class="bg-blue-500 p-2 flex justify-between items-center">
               <span class="font-bold text-lg text-white">Global Data</span>
           </div>
               
           <div class="p-4">
               <!-- Aquí puedes listar tus datos globales -->

               <!-- Ejemplo mostrando el valor de StartMoney -->
               <div class="mb-4 flex justify-center">
                   <span class="text-gray-600">Start Money:</span>
                   <span class="ml-2 font-bold">{{ $data['globalData']->StartMoney }}</span>
               </div>

               <!-- Ejemplo mostrando el valor de StartItemStorage -->
               <div class="mb-4 flex justify-center">
                   <span class="text-gray-600">Start Item Storage:</span>
                   <span class="ml-2 font-bold">{{ $data['globalData']->StartItemStorage }}</span>
               </div>

               <!-- Aquí puedes agregar más campos según lo que quieras mostrar -->

           </div>
       </div>
   @endif
</div>
