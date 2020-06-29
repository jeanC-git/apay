<template>
  <v-container>
    <v-row class="d-flex justify-start align-start mx-5" v-if="arrayPuestos==null">
      <!-- TEXTO POR SI NO TIENEN PUESTOS -->
      <div class="mx-4 my-7" max-width="250">
        <p class="display-1 text--primary" v-text="text_info"></p>
      </div>
    </v-row>
    <v-row class="d-flex justify-start align-start mx-5" v-else>
      <!-- CARD POR SI YA TIENE PUESTOS CREADO -->
      <v-tabs
        v-model="tab"
        background-color="green accent-4"
        class="elevation-2"
        dark
        :centered="centered"
        :grow="grow"
        :vertical="vertical"
        :right="right"
        :prev-icon="prevIcon ? 'mdi-arrow-left-bold-box-outline' : undefined"
        :next-icon="nextIcon ? 'mdi-arrow-right-bold-box-outline' : undefined"
        :icons-and-text="icons"
      >
        <v-tabs-slider></v-tabs-slider>
        <v-tab
          v-for="puesto in arrayPuestos"
          :key="puesto.id"
          :href="`#tab-${puesto.id}`"
          v-text="puesto.nombre"
        ></v-tab>
        <v-tab-item v-for="puesto in arrayPuestos" :key="puesto.id" :value="'tab-' + puesto.id">
          <v-card flat tile>
            <listas :id_puesto="puesto.id" :id_comerciante="puesto.id_comerciante"></listas>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-row>
  </v-container>
</template>
<script>
import listas from "./ListaPendiente.vue";
export default {
    components: {
        listas
    },
    props: ["id_user"],
    data() {
        return {
            text_info: "Aún no tiene listas",
            tab: null,
            icons: false,
            centered: false,
            grow: false,
            vertical: false,
            prevIcon: false,
            nextIcon: false,
            right: false,
            tabs: 3,
            dialog_registro: false,
            arrayCategorias: [],
            mostrar_registro: false,
            arrayPuestos: null,
            base_url: "",
            categorias: ["Abarrotes", "Frutas", "Verduras"],
        };
    },
    created() {
        this.puestosXusuario();
    },
    mounted() {
    },
    methods: {
        puestosXusuario() {
        let me = this;
        axios
            .post("comerciante/verificar_puestos", {
            data: me.id_user
            })
            .then(function(response) {
                if (response.data.data.length > 0) {
                    me.arrayPuestos = response.data.data;
                }
            });
        }
    }
};
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Sacramento&display=swap");
/* .font-sacramento { */
/* font-family: "Sacramento", cursive; */
/* font-size: 3rem; */
/* } */
</style>