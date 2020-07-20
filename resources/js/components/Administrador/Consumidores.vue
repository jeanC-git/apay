<template >
  <v-card width="100%">
    <v-card-title class="headline">
      Gestor de consumidores
      <v-spacer></v-spacer>
      <v-text-field
        v-model="buscador"
        append-icon="mdi-magnify"
        label="Buscar consumidor"
        color="green accent-3"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="consumidores"
      sort-by="name"
      class="elevation-1"
      :loading="loading"
      loading-text="Cargando datos"
      :search="buscador"
      color="green accent-3"
      :footer-props="footerProps"
      no-data-text="No hay consumidores para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
      no-results-text="No hay consumidores para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
    >
    </v-data-table>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
    buscador: "",
    loading: false,
    headers: [
      {
        text: "Nombres",
        align: "start",
        sortable: false,
        value: "name"
      },
      { text: "Correos", value: "email", stortable: false },
     ],
    consumidores: []
  }),

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      let me = this;
      this.consumidores = [];
      axios
        .get("/lista_consumidores")
        .then(function(response) {
          let respuesta = response.data;
          me.consumidores = respuesta.data;
          me.loading = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    }
  }
};
</script>
