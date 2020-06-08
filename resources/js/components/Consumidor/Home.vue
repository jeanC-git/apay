<template>
  <v-row>
    <v-col cols="12" md="4" xs="12" >
    <v-card
        class="mx-auto"
        max-width="344"
        outlined
        v-for="producto in arrayProductos" :key="producto.id"
      >
        <v-list-item three-line>
          <v-list-item-content>
            <div class="overline mb-4" v-text="producto.categoria">OVERLINE</div>
            <v-list-item-title class="headline mb-1">Headline 5</v-list-item-title>
            <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-avatar
            tile
            size="80"
            color="grey"
          ></v-list-item-avatar>
        </v-list-item>
        <v-card-actions>
          <v-btn text>Button</v-btn>
          <v-btn text>Button</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
export default {
  data: () => ({
    arrayProductos:[],
    show: false,
    show2: false,
    show3: false
  }),methods: {
    get_productos(){
      let me = this;
      axios.get("api/apiComercianteProductos")
        .then(function(response) {
          console.log(response.data.data);
          me.arrayProductos=response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    }
  },
};
</script>
