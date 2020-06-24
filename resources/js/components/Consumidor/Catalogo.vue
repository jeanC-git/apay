<template>
  <div style="width:100% !important">
    <v-app-bar color="white" absolute style="position: sticky; top: 10%;" height="auto">
      <v-row>
        <v-col cols="12" xs="12" sm="12" md="3" lg="3" class="pt-1">
          <v-select
            :items="arrayCategoria"
            v-model="filtroCategoria"
            @change="getSubCategorias(), buscar_producto()"
            item-text="nombre"
            item-value="id"
            label="Categoria"
            hide-details
            class="pt-1"
            color="#69F0AE"
          ></v-select>
        </v-col>
        <v-col cols="12" xs="12" sm="12" md="3" lg="3" class="pt-1">
          <v-select
            :items="arraySubcategoria"
            v-model="filtroSubCategoria"
            @change="buscar_producto()"
            item-text="nombre"
            item-value="id"
            label="Subcategoria"
            hide-details
            class="pt-1"
            color="#69F0AE"
            no-data-text="Elija una categoría"
          ></v-select>
        </v-col>
        <v-col cols="12" xs="12" sm="12" md="4" lg="4" class="pt-1">
          <v-text-field
            class="pt-1"
            v-model="buscador"
            append-icon="mdi-magnify"
            label="Busca tu producto"
            single-line
            hide-details
            v-on:keyup="buscar_producto()"
            color="#69F0AE"
          ></v-text-field>
        </v-col>
        <v-col cols="12" xs="12" sm="12" md="1" lg="1" class="text-center pt-3 pb-0">
          <v-btn small outlined rounded color="red" @click="limpiar_filtros()" class="text-center">
            <v-icon class="mr-1">mdi-close</v-icon>Filtros
          </v-btn>
        </v-col>
        <v-col cols="12" xs="12" sm="12" md="1" lg="1" class="text-center pt-1 pb-0">
          <v-btn icon color="green accent-3" @click="abrir_modalProductos" class="pt-1">
            <v-badge
              color="deep-purple accent-4"
              :content="carrito_compras.length >0 ? carrito_compras.length : '0' "
              transition="slide-x-transition"
            >
              <v-icon>mdi-cart</v-icon>
            </v-badge>
          </v-btn>
        </v-col>
      </v-row>
    </v-app-bar>

    <v-container v-if="arrayProductos_n_en_n.length>0">
      <v-card :elevation="'0'" color="#F5F5F7" class="pl-3 pt-3 pr-3">
        <v-row v-for="(array, index) in arrayProductos_n_en_n" :key="index">
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
    <v-container v-else>
      <v-card :elevation="'0'" color="#F5F5F7" class="pl-3 pt-0 pr-3">
        <v-row>
          <v-col
            cols="12"
            xs="12"
            sm="12"
            md="12"
            lg="12"
            style="display:flex; justify-content:center;"
          >
            <v-card class="text-center" style="padding-top: 10%" height="70vh" width="81vw">
              <v-card-text>
                <p
                  class="text-center"
                  style="font-size: 1.5rem"
                >No hay productos disponibles, verifique sus filtros.</p>
                <v-icon x-large>mdi-emoticon-sad</v-icon>
              </v-card-text>
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
    >
      <v-card>
        <v-toolbar dark color="green accent-3" dense>
          <v-btn icon dark @click="dialog_productos = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Lista de compras</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn depressed color="green accent-4" @click="guardar_data()" v-text="'Enviar'"></v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
          <v-row>
            <v-col cols="12" xs="12" sm="12" md="6" lg="6"></v-col>
            <v-col cols="12" xs="12" sm="12" md="6" lg="6" class="text-right">
              <v-btn
                color="green accent-4"
                style="font-size:1.3rem"
                text
                v-text="'#Productos: '+ sumarCantTotal"
              ></v-btn>
              <v-btn
                color="green accent-4"
                style="font-size:1.3rem"
                text
                v-text="'Total: S/. '+ sumartTotales"
              ></v-btn>
            </v-col>
          </v-row>
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
  props: ["id_user"],
  data: () => ({
    dialog_productos: false,
    buscador: "",
    arrayProductos_n_en_n: [],
    carrito_compras: [],
    arrayCategoria: [],
    arraySubcategoria: [],
    filtroCategoria: "",
    filtroSubCategoria: "",
    total_carrito: 0,
    total_cant_carrito: 0
  }),
  computed: {
    sumartTotales() {
      let me = this;
      me.total_carrito = 0;
      me.carrito_compras.forEach(producto => {
        let totalxproducto = producto.cantidad * producto.precio;
        // TOTAL SOLES DE LA LISTA
        me.total_carrito = me.total_carrito + totalxproducto;
      });
      return Math.round(me.total_carrito * 100) / 100;
    },
    sumarCantTotal() {
      let me = this;
      me.total_cant_carrito = 0;
      me.carrito_compras.forEach(producto => {
        // TOTAL CANTIDAD PRODUCTOS DE LA LISTA
        me.total_cant_carrito++;
      });
      return me.total_cant_carrito;
    }
  },
  mounted() {
    this.get_productos();
    this.getCategorias();
  },
  methods: {
    getCategorias() {
      let me = this;
      me.arrayProductos = [];
      axios
        .get("api/apiCategoria")
        .then(function(response) {
          me.arrayCategoria = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getSubCategorias() {
      let me = this;
      axios
        .get("api/apiSubCategoria/" + me.filtroCategoria)
        .then(function(response) {
          me.arraySubcategoria = response.data.data;
        });
    },
    get_productos() {
      let me = this;
      axios.get("api/apiComercianteProductos").then(function(response) {
        me.arrayProductos_n_en_n = response.data.data;
      });
    },
    limpiar_filtros() {
      let me = this;
      me.buscador = "";
      me.filtroCategoria = "";
      me.filtroSubCategoria = "";
      me.buscar_producto();
    },
    buscar_producto() {
      let me = this;
      me.arrayProductos_n_en_n = [];
      axios
        .post("api/apiBuscadorProducto/", {
          filtro: me.buscador,
          categoria: me.filtroCategoria,
          subcategoria: me.filtroSubCategoria
        })
        .then(function(response) {
          me.arrayProductos_n_en_n = response.data.data;
        });
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
              let found;
              me.arrayProductos_n_en_n.forEach(element => {
                found = element.find(
                  element => element.id == me.carrito_compras[producto_index].id
                );
              });
              found.cantidad = 1;
              me.carrito_compras.splice(producto_index, 1);
            }
          });
          break;
      }
    },
    guardar_data() {
      Swal.fire({
        title:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>¿Estás seguro de enviar tu lista de compras?</p>",
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
          let me = this;
          let lista = me.carrito_compras;
          let horario = {
            user_id: me.id_user
          };
          axios
            .post("api/apiProductosConsumidor", {
              data_lista: lista,
              data_horario: horario
            })
            .then(function(response) {
              me.carrito_compras = [];
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
                  "<p style='font-family: Arial, sans-serif'>Se ha enviado la lista correctamente</p>"
              });
            });
        }
      });
    }
  }
};
</script>
