<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-semibold">
            PBSEditor
        </div>
        <div class="hidden md:flex space-x-4">
            <!-- All your regular links here -->
            @php
            //si EBDX es = true en .env mostrar "EBDX Active" en el navbar
            $EBDX = env('EBDX');
            if ($EBDX == true) {
                echo '<p class="text-blue-300 ">EBDX Activo</p>';
            }
            @endphp
            <div class="dropdown relative">
                <a href="#" class="text-white hover:underline inline-block dropdown-toggle">Editar</a>
                <div class="dropdown-content absolute mt-2 space-y-2 py-2 px-4 bg-white shadow-xl rounded text-blue-600 w-52">
                    <!-- Dropdown links -->
                    <a href="{{route('metadata.index')}}" class="block">Metadata</a>
                    <a href="{{route('items.index')}}" class="block">Items</a>
                    <a href="{{route('pokemon.index')}}" class="block">Pokemon</a>
                    <a href="{{route('map.index')}}" class="block">Mapa</a>
                </div>
            </div>
        </div>
        <div class="md:hidden flex items-center">
            <button class="text-white hover:text-gray-300 focus:outline-none focus:text-gray-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        // Dropdown toggle
        $('.dropdown-toggle').click(function(e){
            e.preventDefault();
            $(this).next('.dropdown-content').toggle();
        });
    
        // Close dropdown when clicked outside
        $(document).click(function(e) {
            var target = e.target;
            if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown')) {
                $('.dropdown-content').hide();
            }
        });
    });
    </script>
    