<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <button @click="cambiar_texto()">CAMBIAR</button>
                        <div class="card-header" v-text="texto"></div>
                        <div class="card-header" v-text="texto"></div>
                        <div class="card-header" v-text="texto"></div>
                        <div class="card-header" v-text="texto"></div>
                        <div class="card-header" v-text="texto"></div>
                        <div class="card-header" v-text="texto"></div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                texto:"Hola mundo 2",
                image_url:[],
            }
        },
        methods:{
            cambiar_texto(){
                this.texto="hola que tal";
            },
            traer_imagenes(){
                
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
