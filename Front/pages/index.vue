<script setup>
    definePageMeta({
        name: "home",
        title: "Home",
        meta: [
            {
                name: "Home page",
                content: "Page de listing des derniers films au cinéma",
            },
        ],
    });

    const config = useRuntimeConfig();

    // https://localhost:8000/api/movies/:id
    const { data } = useFetch(config.public.apiBase + "/movies", {
        method: "GET",
    });

    const search = ref(null);

    const filteredData = () => {
        //TODO filtrer en premier les 3 films les plus partagés
        
        return data.value
    }
</script>

<template>
    <div v-if="!data">Loading...</div>
    <div v-else=>
        <h1>Page d'acceuil</h1>

        <div class="container" >
            <Card v-for="movie in filteredData()">
                <div>
                    <div>{{ movie.title }}</div>
                    <div>{{ movie.poster }}</div>
                </div>
                <div>
                    <div>{{ formatDate(movie.releaseDate, "DD/MM/YYYY") }}</div>
                    <div>{{ Math.round(movie.voteAverage) }} / 10</div>
                    <div>Tot. {{ movie.voteCount }}</div>
                    <div>share : {{ movie.share }}</div>
                    <NuxtLink :to="'/movie/'+ movie.id">Voir plus</NuxtLink>
                </div>
            </Card>
        </div>
    </div>
</template>

<style lang='scss' scoped>
    @use "@/assets/scss/index.scss";
</style>