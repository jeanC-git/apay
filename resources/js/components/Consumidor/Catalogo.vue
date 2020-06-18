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
          <v-btn icon color="green accent-3" @click="abrir_modalProductos">
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
                    @click="añadir_carrito(producto)"
                  >
                  <v-icon >mdi-plus</v-icon>
                </v-btn>
              </v-fab-transition>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-card>
    <!-- MODAL LISTA DE PRODUCTOS -->
      <v-dialog
        v-model="dialog_productos"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
        scrollable
        >
        <v-card >
        <v-toolbar
            flat
            dark
            color="primary"
            tile max-height="80px"
          >
            <v-btn
            icon
            dark
            @click="dialog_productos = false"
            >
            <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Lista de compras</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn
                  dark
                  text
                  @click="dialog_productos = false"
                  v-text="'Guardar'"
              ></v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
            <v-list
            three-line
            subheader
            >
            <v-list  >
              <v-subheader>Productos</v-subheader>
              <v-list-item-group  color="primary" >
                <div v-if="array_producto_carrito.length>0" >
                {{array_producto_carrito[0].cantidad}}
                </div>
                <v-list-item  v-for="(producto_lista,index) in array_producto_carrito" :key="producto_lista.id" >
                  <div class="mx-2"  v-text="producto_lista.nombre+' ('+producto_lista.descripcion+')'"></div>
                  <div class="mx-2" v-text="producto_lista.precio"></div>
                  <div class="d-flex" >
                    <v-btn style="border:1px solid"  icon @click="cambiar_cantidad(index,'plus')" > <v-icon color="green" >mdi-plus</v-icon></v-btn>
                    <span style="border:1px solid gray;border-radius:11px" class="d-flex justify-center align-center mx-3 px-2" max-width="10px" v-text="producto_lista.cantidad"></span>
                    <v-icon color="red" @click="cambiar_cantidad(index,'minus')" >mdi-minus</v-icon>
                  </div>
                </v-list-item>
              </v-list-item-group>
            </v-list>
            </v-list>
            <v-divider></v-divider>
        </v-card-text>
        <div style="flex: 1 1 auto;"></div>
        </v-card>
      </v-dialog>
  </div>
</template>
<script>
export default {
  data: () => ({
    dialog_productos:false,
    arrayProductos:[],
    buscador:'',
    array_producto_carrito:[],
  }),mounted() {
    this.get_productos();
  },methods: {
    get_productos(){
      let me = this;
      axios.get("api/apiComercianteProductos").then(function(response) {
        me.arrayProductos=response.data.data;
        me.arrayProductos.forEach(element => {
          element.cantidad=1;
        });
      });
    },buscar_producto(){
      let me=this;
      me.arrayProductos=[];
      let buscador=me.buscador;
      if(buscador==''){
        me.get_productos();
      }else{
        axios.get("api/apiProductosConsumidor/"+me.buscador).then(function(response) {
          me.arrayProductos=response.data.data;
        });
      }
    },abrir_modalProductos(){
      let me = this;
      me.dialog_productos=true;
    },añadir_carrito(producto){
      let me = this;
      me.array_producto_carrito.push(producto);
    },cambiar_cantidad(index,tipo){
      let me = this;
      console.log(me.array_producto_carrito[index].cantidad);
      if (tipo=='plus') {
        me.array_producto_carrito[index].cantidad ++;
      }
      // cantidad = (tipo=='plus') ? cantidad+1 : cantidad-1 ;
      console.log(me.array_producto_carrito[index].cantidad);

    }
  },
};
</script>