document.addEventListener("DOMContentLoaded", () => {
    const pokemonGrid = document.getElementById('pokemon-grid');
    let loadedPokemons = 0;
    const loadBatchSize = 20; // Número de Pokémon a cargar por batch

    async function fetchPokemonBatch(offset, limit) {
        for (let i = offset; i < offset + limit; i++) {
            const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${i + 1}`);
            const pokemon = await response.json();
            displayPokemon(pokemon);
        }
    }

    function displayPokemon(pokemon) {
        const pokemonCard = document.createElement('div');
        pokemonCard.classList.add('pokemon-card');

        const pokemonImage = document.createElement('img');
        pokemonImage.src = pokemon.sprites.front_default;
        pokemonImage.alt = pokemon.name;
        pokemonImage.classList.add('pokemon-image');

        const pokemonDetails = document.createElement('div');
        pokemonDetails.classList.add('pokemon-details');

        pokemonDetails.innerHTML = `
            <h3>${pokemon.name}</h3>
            <p>Nivel: ${pokemon.base_experience}</p>
            <p>${pokemon.types.map(type => type.type.name).join(', ')}</p>
            <button onclick="location.href='detalles.html?id=${pokemon.id}'">Saber más</button>
        `;

        pokemonCard.appendChild(pokemonImage);
        pokemonCard.appendChild(pokemonDetails);

        pokemonGrid.appendChild(pokemonCard);
    }


    function loadMorePokemon(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                fetchPokemonBatch(loadedPokemons, loadBatchSize);
                loadedPokemons += loadBatchSize;
            }
        });
    }

    const observer = new IntersectionObserver(loadMorePokemon, {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    });

    const sentinel = document.querySelector('.sentinel');
    observer.observe(sentinel);

    fetchPokemonBatch(loadedPokemons, loadBatchSize);
    loadedPokemons += loadBatchSize;
});