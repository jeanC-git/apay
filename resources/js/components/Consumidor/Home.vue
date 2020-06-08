<template>
  <div>
    <v-app-bar color="#ffff"
      absolute >
      <v-col cols="12" md="6" dark fab fixed right> 
        <v-text-field
        v-model="buscador"
        append-icon="mdi-magnify"
        label="Busca tu producto"
        single-line
        hide-details
        v-on:keyup="buscar_producto()"
      ></v-text-field>
      </v-col>
    </v-app-bar>
    <v-spacer></v-spacer>
    <v-row class="mt-5" v-if="arrayProductos.length>0">
      <v-col cols="12" md="3" sm="6" v-for="producto in arrayProductos" :key="producto.id">
        <v-card
          class="mx-auto"
          max-width="100%"
          min-height="450"
        >
        <v-img
          class="white--text align-end"
          height="200px"
          :src="'images/productos/'+producto.foto"
        >
          <v-card-title v-if="producto.stock==0" v-text="'No disponible'">
          </v-card-title>
        </v-img>
          <v-card-title class="headline" v-text="producto.nombre"></v-card-title>
        <v-card-text class="text--primary">
          <div v-text="producto.descripcion"></div>
          <div v-text="'S/.'+producto.precio + ' x ' +producto.unidad "></div>
        </v-card-text>
        <v-card-text class="d-flex justify-center">
          <div v-if="producto.stock==0" v-text="'No disponible'"></div>
        </v-card-text>
        <v-card-actions class="d-flex justify-center"  v-if="producto.stock>0">
          <v-btn color="orange" text @click="dialog_stock=true">
            Añadir
          </v-btn>
        </v-card-actions>
      </v-card>
      </v-col>
    </v-row>
    <!-- MODAL PARA AÑADIR STOCK -->
    <v-dialog v-model="dialog_stock" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Use Google's location service?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="dialog_stock = false">Disagree</v-btn>
          <v-btn color="green darken-1" text @click="dialog_stock = false">Agree</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  data: () => ({
    arrayProductos:[],
    dialog_stock:false,
    buscador:'',
  }),mounted() {
    this.get_productos();
  },methods: {
    get_productos(){
      let me = this;
      axios.get("api/apiComercianteProductos").then(function(response) {
        console.log(response.data.data);
        me.arrayProductos=response.data.data;
      });
    },buscar_producto(){
      let me=this;
      me.arrayProductos=[];
      let buscador=me.buscador;
      if(buscador==''){
        me.get_productos();
      }else{
        axios.get("api/apiProductosConsumidor/"+me.buscador).then(function(response) {
          console.log(response.data.data);
          me.arrayProductos=response.data.data;
        });
      }
    }
  },
};
</script>
