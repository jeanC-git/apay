<template>
  <div height="100%" width="100%">
    <v-app-bar color="#ffff" absolute height="auto" dense>
      <v-row>
        <v-col cols="12" xs="12" sm="10" md="4">
          <p class="h1">Lleva lo que necesites</p>
        </v-col>
        <v-col cols="12" xs="6" sm="8" md="6" dark fab fixed right>
          <v-text-field
            v-model="buscador"
            append-icon="mdi-magnify"
            label="Busca tu producto"
            single-line
            hide-details
            v-on:keyup="buscar_producto()"
          ></v-text-field>
        </v-col>
        <v-col cols="12" xs="6" sm="4" md="2" class="d-flex justify-end">
          <v-btn icon color="green accent-3" @click="abrir_modalProductos">
            <v-icon>mdi-cart</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-app-bar>

    <v-container class="mt-5">
      <v-card :elevation="'0'" color="white" class="mt-5 pl-3 pt-2">
        <v-row v-for="(array, index) in arrayProductos_3_en_3" :key="index">
          <v-col
            cols="12"
            xs="12"
            sm="6"
            md="4"
            lg="4"
            v-for="producto in array"
            :key="producto.id"
          >
            <v-card color="green accent-3">
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
              <v-container>
                <v-card class="d-flex">
                  <v-img :src="producto.foto" aspect-ratio="1.5"></v-img>
                </v-card>
              </v-container>
              <v-card-text>
                <v-list-item two-line>
                  <v-list-item-content>
                    <v-list-item-subtitle v-text="producto.nombre+' - '+producto.descripcion"></v-list-item-subtitle>
                    <v-list-item-subtitle
                      v-text="'S/. '+producto.precio+' x '+ producto.unidad"
                    >Precio</v-list-item-subtitle>
                    <v-list-item-subtitle v-if="array.length>0">Disponible</v-list-item-subtitle>
                    <v-list-item-subtitle v-else>No disponible</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-fab-transition>
                  <v-btn color="yellow darken-1" right fab @click="añadir_carrito(producto)">
                    <v-icon>mdi-plus</v-icon>
                  </v-btn>
                </v-fab-transition>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-card>
    </v-container>
    <!-- MODAL LISTA DE PRODUCTOS -->
    <v-dialog
      v-model="dialog_productos"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
    >
      <v-card>
        <v-toolbar flat dark color="yellow darken-1" tile max-height="80px">
           <v-toolbar-title>Mi lista</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn
                  dark
                  text
                  color="grey darken-3"
                  @click="dialog_productos = false"
                >
                  Procesar
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                color="green accent-3"
                icon
                dark
                @click="dialog_productos = false"
              >
                <v-icon>mdi-close</v-icon>
              </v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
          <v-list three-line subheader>
            <v-list style="overflow:auto" min-width="600px">
              <v-list-item-group color="primary">
                <v-row container>
                  <v-col cols="12" sm="1" xs="1" md="1" class="d-flex justify-center align-center">
                    <v-subheader>#</v-subheader>
                  </v-col>
                  <v-col cols="12" sm="1" xs="1" md="1" class="d-flex justify-center align-center">
                    <v-subheader>Puesto</v-subheader>
                  </v-col>
                  <v-col cols="12" sm="3" xs="3" md="3" class="d-flex justify-center align-center">
                    <v-subheader>Productos</v-subheader>
                  </v-col>
                  <v-col cols="12" sm="3" xs="3" md="3" class="d-flex justify-center align-center">
                    <v-subheader>Precio</v-subheader>
                  </v-col>
                  <v-col cols="12" sm="2" xs="2" md="2" class="d-flex justify-center align-center">
                    <v-subheader>Cantidad</v-subheader>
                  </v-col>
                  <v-col cols="12" sm="2" xs="2" md="2" class="d-flex justify-center align-center">
                    <v-subheader>Costo</v-subheader>
                  </v-col>
                </v-row>
                <v-list-item
                  v-for="(producto_lista,index) in carrito_compras"
                  :key="producto_lista.id"
                  style="max-height:20px;padding:0"
                >
                  <v-row>
                    <v-col
                      cols="12"
                      sm="1"
                      xs="1"
                      md="1"
                      class="d-flex justify-center align-center"
                    >
                      <v-btn
                        icon
                        style="border:1px solid"
                        @click="modificar_lista(index,'eliminar')"
                      >
                        <v-icon color="red">mdi-delete</v-icon>
                      </v-btn>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="1"
                      xs="1"
                      md="1"
                      class="d-flex justify-center align-center"
                    >
                      <div
                        v-text="producto_lista.nombre_puesto+' - '+ producto_lista.numero_puesto"
                      ></div>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="3"
                      xs="3"
                      md="3"
                      class="d-flex justify-center align-center"
                    >
                      <div v-text="producto_lista.nombre+' ('+producto_lista.descripcion+')'"></div>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="3"
                      xs="3"
                      md="3"
                      class="d-flex justify-center align-center"
                    >
                      <div v-text="'S/. '+producto_lista.precio+' x '+ producto_lista.unidad"></div>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="2"
                      xs="2"
                      md="2"
                      class="d-flex justify-center align-center"
                    >
                      <v-btn style="border:1px solid" icon @click="modificar_lista(index,'minus')">
                        <v-icon color="red">mdi-minus</v-icon>
                      </v-btn>
                      <div style="max-width:60px;">
                        <v-text-field
                          style="text-align:center"
                          @keyup="modificar_lista(index,'mayor')"
                          v-model="producto_lista.cantidad"
                          class="mx-3"
                        ></v-text-field>
                      </div>
                      <v-btn style="border:1px solid" icon @click="modificar_lista(index,'plus') ">
                        <v-icon color="green">mdi-plus</v-icon>
                      </v-btn>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="2"
                      xs="2"
                      md="2"
                      class="d-flex justify-center align-center"
                    >
                      <div
                        v-text="'S/.'+Math.round(producto_lista.precio*producto_lista.cantidad * 100) / 100"
                      ></div>
                    </v-col>
                  </v-row>
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
  props: {
      ventana_lista: false,
  },
  data: () => ({
    dialog_productos: false,
    arrayProductos_3_en_3: [],
    buscador: "",
    carrito_compras: []
  }),
  mounted() {
    this.get_productos();
  },
  methods: {
    get_productos() {
      let me = this;
      axios.get("api/apiComercianteProductos").then(function(response) {
        me.arrayProductos_3_en_3 = response.data.data;
      });
    },
    buscar_producto() {
      let me = this;
      me.arrayProductos = [];
      let buscador = me.buscador;
      if (buscador == "") {
        me.get_productos();
      } else {
        axios
          .get("api/apiProductosConsumidor/" + me.buscador)
          .then(function(response) {
            me.arrayProductos = response.data.data;
          });
      }
    },
    abrir_modalProductos() {
      let me = this;
      me.dialog_productos = true;
    },
    añadir_carrito(producto) {
      let me = this;
      let valor;
      const found = me.carrito_compras.find(
        element => element.id == producto.id
      );
      console.log(found);
      if (found == undefined) {
        me.carrito_compras.push(producto);
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: false,
          onOpen: toast => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          }
        });
        Toast.fire({
          icon: "success",
          title:
            "<p style='font-family: Arial, sans-serif'>Se ha añadido el producto a la lista</p>"
        });
      } else {
        found.cantidad++;
      }
    },
    modificar_lista(producto_index, tipo) {
      let me = this;
      switch (tipo) {
        case "plus":
          me.carrito_compras[producto_index].cantidad++;
          break;
        case "minus":
          if (me.carrito_compras[producto_index].cantidad > 1) {
            me.carrito_compras[producto_index].cantidad--;
          }
          break;
        case "mayor":
          if (me.carrito_compras[producto_index].cantidad == 0) {
            me.carrito_compras[producto_index].cantidad++;
          }
          break;
        case "eliminar":
          Swal.fire({
            title:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>¿Estás seguro de eliminar el producto de la lista?</p>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Aceptar</p>",
            cancelButtonText:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Cancelar</p>"
          }).then(result => {
            if (result.value) {
              const found = me.arrayProductos.find(
                element => element.id == me.carrito_compras[producto_index].id
              );
              found.cantidad = 1;
              me.carrito_compras.splice(producto_index, 1);
            }
          });
          break;
      }
    }
  }
};
</script>
