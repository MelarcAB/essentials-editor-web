@extends('app')
@section('content')
    <!-- Container -->
    <div class="bg-blue-200 min-h-screen p-4 md:p-8">

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl md:text-4xl font-bold mb-2 text-blue-900">Pokémon Editor</h1>
            <p class="text-sm md:text-base text-gray-600">Edit or create your Pokémon's details.</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-lg">

            <!-- Stats & Abilities -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <!-- Stats -->
                <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl md:text-2xl font-bold mb-6 text-blue-800">Stats</h2>

                    <!-- Types -->
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label for="types1" class="block text-base font-semibold text-gray-700 mb-1">Type 1:</label>
                            <input type="text" id="types1" name="types1"
                                value="{{ explode(',', $pokemon->Types)[0] }}" placeholder="GRASS"
                                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="types2" class="block text-base font-semibold text-gray-700 mb-1">Type 2:</label>
                            <input type="text" id="types2" name="types2"
                                value="{{ explode(',', $pokemon->Types)[1] ?? '' }}" placeholder="POISON"
                                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Base Stats -->
                    @php
                        $statsNames = ['HP', 'Attack', 'Defense', 'Speed', 'Special Attack', 'Special Defense'];
                        $baseStatsValues = explode(',', $pokemon->BaseStats);
                    @endphp

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($baseStatsValues as $index => $value)
                            <div>
                                <label for="base_stat_{{ $statsNames[$index] }}"
                                    class="block text-base font-semibold text-gray-700 mb-1">{{ $statsNames[$index] }}:</label>
                                <input type="text" id="base_stat_{{ $statsNames[$index] }}"
                                    name="base_stats[{{ $statsNames[$index] }}]" value="{{ $value }}"
                                    placeholder="45"
                                    class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Abilities -->
                <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl md:text-2xl font-bold mb-6 text-blue-800">Abilities</h2>

                    <!-- Regular Abilities -->
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        @php
                            $abilitiesOfPokemon = explode(',', $pokemon->Abilities);
                        @endphp
                        @for ($i = 0; $i < 4; $i++)
                            <div>
                                <label for="ability{{ $i + 1 }}"
                                    class="block text-base font-semibold text-gray-700 mb-1">Ability
                                    {{ $i + 1 }}:</label>
                                <select id="ability{{ $i + 1 }}" name="abilities[]"
                                    class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Select --</option>
                                    @foreach ($abilities as $ability)
                                        <option value="{{ $ability->Name }}"
                                            {{ isset($abilitiesOfPokemon[$i]) && strtoupper(str_replace(' ','',$abilitiesOfPokemon[$i])) == strtoupper(str_replace(' ','',$ability->Name)) ? 'selected' : '' }}>
                                            {{ $ability->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                    </div>

                    <!-- Hidden Abilities -->
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        @php
                            $hiddenAbilitiesOfPokemon = explode(',', $pokemon->HiddenAbilities);
                        @endphp
                        @for ($i = 0; $i < 2; $i++)
                            <div>
                                <label for="hidden_ability{{ $i + 1 }}"
                                    class="block text-base font-semibold text-gray-700 mb-1">Hidden Ability
                                    {{ $i + 1 }}:</label>
                                <select id="hidden_ability{{ $i + 1 }}" name="hidden_abilities[]"
                                    class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Select --</option>
                                    @foreach ($abilities as $ability)
                                        <option value="{{ $ability->Name }}"
                                            {{ isset($hiddenAbilitiesOfPokemon[$i]) && strtoupper($hiddenAbilitiesOfPokemon[$i]) == strtoupper($ability->Name) ? 'selected' : '' }}>
                                            {{ $ability->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                    </div>
                </div>


            </div>

            <!-- Sprites -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-lg md:text-xl font-bold mb-4 text-blue-700">Sprites</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($pokemon->getSprites() as $spriteName => $spritePath)
                        <div class="text-center">
                            <img src="{{ $spritePath }}" alt="{{ $spriteName }}"
                                class="w-24 h-24 mx-auto mb-2 rounded-lg shadow">
                            <p class="text-sm md:text-base font-medium text-gray-700 capitalize">{{ $spriteName }}</p>
                            <input type="file" name="sprite_{{ $spriteName }}"
                                class="mt-2 text-sm px-2 py-1 border rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Additional Pokémon Details -->
            <div class="bg-blue-100 p-4 my-4 rounded-lg shadow-md flex flex-wrap">
                <h2 class="text-xl md:text-2xl font-bold mb-6 text-blue-800">Additional Details</h2>
                <div class=" mb-4 w-1/2 px-2"></div>

                <!-- Gender Ratio -->
                <div class=" mb-4 w-1/2 px-2">
                    <label for="gender_ratio" class="block text-base font-semibold text-gray-700 mb-2">Gender Ratio:</label>
                    <select id="gender_ratio" name="gender_ratio"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="AlwaysMale" @if ($pokemon->GenderRatio === 'AlwaysMale') selected @endif>Always Male</option>
                        <option value="FemaleOneEighth" @if ($pokemon->GenderRatio === 'FemaleOneEighth') selected @endif>Female One Eighth
                        </option>
                        <option value="Female25Percent" @if ($pokemon->GenderRatio === 'Female25Percent') selected @endif>Female 25%
                        </option>
                        <option value="Female50Percent" @if ($pokemon->GenderRatio === 'Female50Percent') selected @endif>Female 50%
                        </option>
                        <option value="Female75Percent" @if ($pokemon->GenderRatio === 'Female75Percent') selected @endif>Female 75%
                        </option>
                        <option value="FemaleSevenEighths" @if ($pokemon->GenderRatio === 'FemaleSevenEighths') selected @endif>Female Seven
                            Eighths</option>
                        <option value="AlwaysFemale" @if ($pokemon->GenderRatio === 'AlwaysFemale') selected @endif>Always Female
                        </option>
                        <option value="Genderless" @if ($pokemon->GenderRatio === 'Genderless') selected @endif>Genderless</option>
                    </select>
                </div>

                <!-- Growth Rate -->
                <div class=" mb-4 w-1/2 px-2">
                    <label for="growth_rate" class="block text-base font-semibold text-gray-700 mb-2">Growth Rate:</label>
                    <select id="growth_rate" name="growth_rate"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="Fast" @if ($pokemon->GrowthRate === 'Fast') selected @endif>Fast</option>
                        <option value="Medium" @if ($pokemon->GrowthRate === 'Medium') selected @endif>Medium</option>
                        <option value="Slow" @if ($pokemon->GrowthRate === 'Slow') selected @endif>Slow</option>
                        <option value="Parabolic" @if ($pokemon->GrowthRate === 'Parabolic') selected @endif>Parabolic</option>
                        <option value="Erratic" @if ($pokemon->GrowthRate === 'Erratic') selected @endif>Erratic</option>
                        <option value="Fluctuating" @if ($pokemon->GrowthRate === 'Fluctuating') selected @endif>Fluctuating</option>
                    </select>
                </div>

                <!-- Base Experience -->
                <div class="mb-4 w-1/2 px-2">
                    <label for="base_exp" class="block text-base font-semibold text-gray-700 mb-2">Base Experience:</label>
                    <input type="number" id="base_exp" name="base_exp" value="{{ $pokemon->BaseExp }}"
                        placeholder="Enter base experience" min="1"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Catch Rate -->
                <div class="mb-4 w-1/2 px-2">
                    <label for="catch_rate" class="block text-base font-semibold text-gray-700 mb-2">Catch Rate:</label>
                    <input type="number" id="catch_rate" name="catch_rate" value="{{ $pokemon->CatchRate }}"
                        placeholder="Enter catch rate" min="0" max="255"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- EVs -->
                <div class="mb-4">
                    <label class="block text-base font-semibold text-gray-700 mb-2">EVs:</label>
                    @php
                        $stats = ['HP', 'ATTACK', 'DEFENSE', 'SPEED', 'SPECIAL_ATTACK', 'SPECIAL_DEFENSE'];

                        // Descomponer la cadena $pokemon->EVs en un array asociativo
                        $evArray = explode(',', $pokemon->EVs);
                        $evValues = [];
                        for ($i = 0; $i < count($evArray); $i += 2) {
                            $evValues[$evArray[$i]] = $evArray[$i + 1];
                        }
                    @endphp
                    @foreach ($stats as $stat)
                        <div class="flex justify-between items-center mb-2">
                            <label for="ev_{{ strtolower($stat) }}"
                                class="text-sm md:text-base font-medium text-gray-700">{{ str_replace('_', ' ', $stat) }}:</label>
                            <input type="number" id="ev_{{ strtolower($stat) }}" name="evs[{{ $stat }}]"
                                placeholder="Enter EV" min="0"
                                class="w-1/2 px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ $evValues[$stat] ?? 0 }}">
                        </div>
                    @endforeach
                </div>




            </div>
            <div class="bg-blue-100 p-4 rounded-lg shadow-md mt-6">
                <h2 class="text-xl md:text-2xl font-bold mb-6 text-blue-800">Moves</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full table-fixed">
                        <thead>
                            <tr class="text-left bg-blue-200">
                                <th class="px-4 py-2 w-1/6">Level</th>
                                <th class="px-4 py-2 w-5/6">Move</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $moves = $pokemon->getMoves();
                            @endphp
                            @foreach ($moves as $move)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $move['level'] }}</td>
                                    <td class="px-4 py-2 border">{{ $move['move']->Name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            


        </div>
    </div>
@endsection
