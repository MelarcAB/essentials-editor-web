@extends('app')

@section('content')
    <div class="w-full px-4 py-4">
        <h1 class="text-2xl font-bold mb-4">Detalles del Item</h1>
        <form action="" method="POST" class="flex flex-wrap">
            @csrf
            @if (isset($item))
                @method('PUT')
            @endif

            <!-- Columna 1 -->
            <div class="w-full md:w-1/2 px-4 mb-4">
                <div class="mb-4">
                    <img src="{{ $item->getSprite() }}" alt="" class="w-24 h-24 mx-auto mb-2 rounded-lg shadow">
                    <p class="text-sm md:text-base font-medium text-gray-700 capitalize">{{ $item->Name }}</p>
                    <input type="file" name="sprite{{ $item->Name }}"
                        class="mt-2 text-sm px-2 py-1 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <!-- Campos comunes -->
                <div class="mb-4">
                    <label for="Name" class="block text-gray-600 font-semibold">Nombre</label>
                    <input type="text" name="Name" id="Name" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('Name', isset($item) ? $item->Name : '') }}" required>
                </div>



                <div class="mb-4">
                    <label for="Description" class="block text-gray-600 font-semibold">Descripción</label>
                    <textarea name="Description" id="Description" class="w-full px-3 py-2 border rounded-lg" rows="4" required>{{ old('Description', isset($item) ? $item->Description : '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="Price" class="block text-gray-600 font-semibold">Precio</label>
                    <input type="text" name="Price" id="Price" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('Price', isset($item) ? $item->Price : '') }}" required>
                </div>
                <div class="mb-4">
                    <label for="Flags" class="block text-gray-600 font-semibold">Flags</label>
                    <select name="Flags[]" id="Flags" class="w-full px-3 py-2 border rounded-lg" multiple>
                        <option value="Mail"
                            {{ in_array('Mail', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Mail - The item is a Mail item.</option>
                        <option value="IconMail"
                            {{ in_array('IconMail', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            IconMail - The item is a Mail item, and the images of the holder and two other party Pokémon
                            appear on the Mail.</option>
                        <option value="PokeBall"
                            {{ in_array('PokeBall', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            PokeBall - The item is a Poké Ball item.</option>
                        <option value="SnagBall"
                            {{ in_array('SnagBall', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            SnagBall - The item is a Snag Ball (i.e. it can capture enemy trainers' Shadow Pokémon).
                        </option>
                        <option value="Berry"
                            {{ in_array('Berry', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Berry - The item is a berry that can be planted.</option>
                        <option value="KeyItem"
                            {{ in_array('KeyItem', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            KeyItem - The item is a Key Item.</option>
                        <option value="EvolutionStone"
                            {{ in_array('EvolutionStone', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            EvolutionStone - The item is an evolution stone.</option>
                        <option value="Fossil"
                            {{ in_array('Fossil', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Fossil - The item is a fossil that can be revived. Not to be used for the incomplete fossils
                            from Gen 8 which are pieced together to revive a Pokémon.</option>
                        <option value="Apricorn"
                            {{ in_array('Apricorn', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Apricorn - The item is an Apricorn that can be converted into a Poké Ball.</option>
                        <option value="TypeGem"
                            {{ in_array('TypeGem', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            TypeGem - The item is an elemental power-raising Gem.</option>
                        <option value="Mulch"
                            {{ in_array('Mulch', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Mulch - The item is mulch that can be spread on berry patches.</option>
                        <option value="MegaStone"
                            {{ in_array('MegaStone', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            MegaStone - The item is a Mega Stone. This does NOT include the Red/Blue Orbs.</option>
                        <option value="MegaRing"
                            {{ in_array('MegaRing', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            MegaRing - The item is a Mega Ring, which allows Mega Evolution.</option>
                        <option value="Repel"
                            {{ in_array('Repel', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Repel - The item is a Repel, and can be used automatically when a Repel runs out.</option>
                        <option value="Fling_30"
                            {{ in_array('Fling_30', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            Fling_30 - The item can be thrown by the move Fling. The number is Fling's base power when used
                            with the item. The number can be any number, but should be greater than 0.</option>
                        <option value="NaturalGift_POISON_80"
                            {{ in_array('NaturalGift_POISON_80', old('Flags', isset($item) ? explode(',', $item->Flags) : [])) ? 'selected' : '' }}>
                            NaturalGift_POISON_80 - The item can be used by the move Natural Gift. The type and number are
                            Natural Gift's type and base power when used with the item. The type can be any type, and the
                            number can be any number but should be greater than 0.</option>
                    </select>
                </div>


            </div>

            <!-- Columna 2 -->
            <div class="w-full md:w-1/2 px-4 mb-4">
                <!-- Campo Battle Use (select) -->
                <div class="mb-4">
                    <label for="BattleUse" class="block text-gray-600 font-semibold">Battle Use</label>
                    <select name="BattleUse" id="BattleUse" class="w-full px-3 py-2 border rounded-lg" required>
                        <option value="OnPokemon" {{ isset($item) && $item->BattleUse === 'OnPokemon' ? 'selected' : '' }}>
                            On Pokemon</option>
                        <option value="OnMove" {{ isset($item) && $item->BattleUse === 'OnMove' ? 'selected' : '' }}>On
                            Move</option>
                        <option value="OnBattler" {{ isset($item) && $item->BattleUse === 'OnBattler' ? 'selected' : '' }}>
                            On Battler</option>
                        <option value="OnFoe" {{ isset($item) && $item->BattleUse === 'OnFoe' ? 'selected' : '' }}>On Foe
                        </option>
                        <option value="Direct" {{ isset($item) && $item->BattleUse === 'Direct' ? 'selected' : '' }}>Direct
                        </option>
                    </select>
                </div>

                <!-- Campos adicionales -->
                <div class="mb-4">
                    <label for="FieldUse" class="block text-gray-600 font-semibold">Field Use</label>
                    <input type="text" name="FieldUse" id="FieldUse" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('FieldUse', isset($item) ? $item->FieldUse : '') }}">
                </div>

                <div class="mb-4">
                    <label for="Type" class="block text-gray-600 font-semibold">Type</label>
                    <input type="text" name="Type" id="Type" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('Type', isset($item) ? $item->Type : '') }}">
                </div>

                <div class="mb-4">
                    <label for="Move" class="block text-gray-600 font-semibold">Move</label>
                    <input type="text" name="Move" id="Move" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('Move', isset($item) ? $item->Move : '') }}">
                </div>

                <div class="mb-4">
                    <label for="IdName" class="block text-gray-600 font-semibold">Id Name</label>
                    <input type="text" name="IdName" id="IdName" class="w-full px-3 py-2 border rounded-lg"
                        value="{{ old('IdName', isset($item) ? $item->IdName : '') }}">
                </div>
            </div>

            <!-- Botón de submit -->
            <div class="w-full mt-6">
                <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600">
                    {{ isset($item) ? 'Actualizar Item' : 'Crear Item' }}
                </button>
            </div>
        </form>
    </div>
@endsection
