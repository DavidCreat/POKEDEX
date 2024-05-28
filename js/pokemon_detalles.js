document.addEventListener("DOMContentLoaded", () => {
    const pokemonDetailsPage = document.getElementById('pokemon-details-page');
    const pokemonImageContainer = document.getElementById('pokemon-image');
    const urlParams = new URLSearchParams(window.location.search);
    const pokemonId = urlParams.get('id');

    const typeColors = {
        fire: '#F08030',
        water: '#6890F0',
        grass: '#78C850',
        electric: '#F8D030',
        ice: '#98D8D8',
        fighting: '#C03028',
        poison: '#A040A0',
        ground: '#E0C068',
        flying: '#A890F0',
        psychic: '#F85888',
        bug: '#A8B820',
        rock: '#B8A038',
        ghost: '#705898',
        dark: '#705848',
        dragon: '#7038F8',
        steel: '#B8B8D0',
        fairy: '#EE99AC',
        normal: '#A8A878'
    };

    async function fetchPokemonDetails(id) {
        const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
        const pokemon = await response.json();
        const highQualityImageURL = pokemon.sprites.other['official-artwork'].front_default;
        displayPokemonDetails(pokemon, highQualityImageURL);
        setPokemonTypeStyles(pokemon.types);
        adjustPokeballImagePosition();
    }

    function displayPokemonDetails(pokemon, highQualityImageURL) {
        pokemonDetailsPage.innerHTML = `
            <h1>${pokemon.name}</h1>
            <p>Nivel: ${pokemon.base_experience}</p>
            <p>Tipos: ${pokemon.types.map(type => type.type.name).join(', ')}</p>
            <p>Altura: ${pokemon.height}</p>
            <p>Peso: ${pokemon.weight}</p>
            <img src="../img/bokebola.png" alt="Pokedex" class="center-image" id="pokeball-image">
            <button class="button-32" role="button" onclick="redirectToMain()">MIRAR MAS POKEMONS</button>
        `;

        pokemonImageContainer.innerHTML = `
            <img src="${highQualityImageURL || pokemon.sprites.front_default}" alt="${pokemon.name}">
        `;
    }

    function setPokemonTypeStyles(types) {
        const primaryType = types[0].type.name;
        const color = typeColors[primaryType] || '#000000';
        pokemonImageContainer.style.backgroundColor = color;
        document.querySelector('.pokemon-info h1').style.color = color;
    }

    function adjustPokeballImagePosition() {
        const pokeballImage = document.getElementById('pokeball-image');
        const pokemonInfo = document.querySelector('.pokemon-info');
        const infoWidth = pokemonInfo.scrollWidth;
        pokeballImage.style.left = `${infoWidth + 20}px`;
    }

    if (pokemonId) {
        fetchPokemonDetails(pokemonId);
    } else {
        pokemonDetailsPage.innerHTML = `<p>No se encontró información del Pokémon.</p>`;
    }

    // Re-adjust Pokeball image position on window resize
    window.addEventListener('resize', adjustPokeballImagePosition);
});

function redirectToMain() {
    window.location.href = 'main.html';
}
/*BY: DAVID CREAT - EAS1*/