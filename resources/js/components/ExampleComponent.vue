<template>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">API de autoria de: <a href="https://newsapi.org/">News API!</a></h1>
            <p class="lead">Um uso simple do Vue.Js com Components do Laravel</p>
            <hr class="my-4">
            <p>Sim, Sim, Vue não é meu forte, mas to aprendendo quando da, ja que estou fazendo muito projetos ultimamente, é complicado arrumar tempo.
            Jaja sai mais.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="https://github.com/AlexmarJr" role="button">Alguns dos meus Projetos</a>
            </p>
        </div>
    </div>
</template>
 
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
    
</script>