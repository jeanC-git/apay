<template>
  <div height="100%" width="100%">
    <v-app-bar color="#ffff" absolute >
      <v-col cols="12" md="4" xs="9" sm="10">
          <v-list-item>
              <v-list-item-content>
                  <v-list-item-title class="headline" >Lleva lo que necesites</v-list-item-title>
              </v-list-item-content>
        </v-list-item>
      </v-col>
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
        <v-col cols="12" md="2" xs="3" sm="2" class="d-flex justify-end">
          <v-btn icon color="green accent-3" >
                <v-icon>mdi-cart</v-icon>
          </v-btn>
        </v-col>
    </v-app-bar>
    <br>
    <v-card width="100%" color="#F5F5F7" class="mt-5 pl-3 pt-2" height="100vh" >
      <v-row  v-if="arrayProductos.length>0" class="d-flex justify-start">
        <v-col  cols="12" md="3" sm="6" v-for="producto in arrayProductos" :key="producto.id">
          <v-card
            width="100%"
            class="mx-auto"
            color="green accent-3"
          >
            <v-list-item>
              <v-list-item-avatar>
                <v-img
                  src="https://img2.freepng.es/20180623/iqh/kisspng-computer-icons-avatar-social-media-blog-font-aweso-avatar-icon-5b2e99c40ce333.6524068515297806760528.jpg"
                ></v-img>
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title v-text="producto.nombre_puesto"></v-list-item-title>
                <v-list-item-subtitle v-text="producto.numero_puesto"></v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-img
              :src="producto.foto"
              height="100"
            ></v-img>
            <v-card-text>
              <v-list-item two-line>
                <v-list-item-content>
                    <v-list-item-subtitle v-text="producto.nombre+' - '+producto.descripcion"></v-list-item-subtitle>
                    <v-list-item-subtitle v-text="'S/. '+producto.precio+' x '+ producto.unidad">Precio</v-list-item-subtitle>
                    <v-list-item-subtitle v-if="arrayProductos.length>0">Disponible</v-list-item-subtitle>
                    <v-list-item-subtitle v-else>No disponible</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-fab-transition>
                <v-btn
                    color="yellow darken-1"      
                    right
                    fab
                  >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </v-fab-transition>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-card>
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