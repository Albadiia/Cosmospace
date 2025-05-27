<script setup>
    definePageMeta({
        name: "info",
        title: "Détail",
        meta: [
            {
                name: "Page info film",
                content: "Page détail d'un film",
            },
        ],
    });

    const config = useRuntimeConfig();
    const id = useRoute().params.id;

    // https://localhost:8000/api/movie_infos/:id
    const { data } = useFetch(config.public.apiBase + "/movie_infos/" + id, {
        method: "GET",
    });

    const share = () => {
        console.log('shared');
        
        // https://localhost:8000/api/movies/:id
        useFetch(config.public.apiBase + "/movies/" + id, {
            method: "PATCH",
            headers: {
                "Content-type": "application/merge-patch+json"
            },
            body: {
                share: data.value.share += 1
            }
        });
    }
</script>

<template>
    <div v-if="!data">Loading...</div>
    <div v-else>
        <h1>Page détail</h1>

        <h3>{{ data.title }}</h3>
        <h4>Budget :</h4>
        <p>{{ data.budget }}</p>
        <h4>Revenue :</h4>
        <p>{{ data.revenue }}</p>
        <div>
            <h4>Genres :</h4>
            <p v-for="genre in data.genre">{{ genre.name }}</p>
        </div>
        <div>
        <h4>Entreprises de production :</h4>
            <p v-for="company in data.productionCompany">{{ company.name }}</p>
        </div>
        <div>
            <h4>Pays de production :</h4>
            <p v-for="country in data.productionCountry">{{ country.name }}</p>
        </div>

        <p>Nb partage: {{ data.share }}</p>
        <button @click="share()">Partager</button>
    </div>
</template>

<style lang='scss' scoped>
    @use "@/assets/scss/movie/id.scss";
</style>