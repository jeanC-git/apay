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
            sm="4"
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
        <v-toolbar flat dark color="yellow darken-1" tile max-height="80px">
          <v-toolbar-title>Lista de compras</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark
                  text
                  color="grey darken-3"  @click="get_horario()" v-text="'Enviar'"></v-btn>
          </v-toolbar-items>
          <v-btn icon dark @click="dialog_productos = false" color="green accent-4">
            <v-icon>mdi-close</v-icon>
          </v-btn>
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
          <v-simple-table height="100%">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center" style="min-width:180px;">Productos</th>
                  <th class="text-center" style="min-width:160px;">Precio</th>
                  <th class="text-center" style="min-width:169px;">Cantidad</th>
                  <th class="text-center" style="min-width:120px;">Costo</th>
                </tr>
              </thead>
              <tbody v-for="(producto_lista,index) in carrito_compras" :key="producto_lista.id">
                <td colspan="6" v-if="comprobar_puesto(producto_lista.numero_puesto,index)" class="txt_puesto">
                  {{producto_lista.nombre_puesto+' #'+ producto_lista.numero_puesto}}
                </td>
                <tr >
                  <td class="text-center">
                    <v-btn icon style="border:1px solid" @click="modificar_lista(index,'eliminar')">
                      <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                  </td>
                  <td
                    class="text-center"
                    v-text="producto_lista.nombre+' ('+producto_lista.descripcion+')'"
                  ></td>
                  <td
                    class="text-center"
                    v-text="'S/. '+producto_lista.precio+' x '+ producto_lista.unidad"
                  ></td>
                  <td class="d-flex justify-center align-center">
                    <v-btn style="border:1px solid" icon @click="modificar_lista(index,'minus')">
                      <v-icon color="red">mdi-minus</v-icon>
                    </v-btn>
                    <div style="max-width:100px;">
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
                  </td>
                  <td
                    class="text-center"
                    v-text="'S/.'+Math.round(producto_lista.precio*producto_lista.cantidad * 100) / 100"
                  ></td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card-text>
      </v-card>
    </v-dialog>
    <!-- MODAL DE HORARIO -->
    <v-dialog v-model="dialog_horario"
      >
      <v-card>
        <v-card-title v-text="'Escoja el horario de recojo: '"></v-card-title>
        <v-form @submit.prevent="enviar_lista()">
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-dialog
                  ref="dialog"
                  v-model="modal_calendar"
                  :return-value.sync="date"
                  persistent
                  width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="date"
                      label="Fecha de recojo"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" scrollable locale="es-419" :min="fecha_ini_calendar" :max="fecha_fin_calendar">
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="modal_calendar = false">Cancelar</v-btn>
                    <v-btn text color="primary" @click="$refs.dialog.save(date),cambiar_horarioXfecha()">Elegir</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-select
                  :items="arrayHorario"
                  item-text="hora_inicio"
                  item-value="id"
                  label="Hora de recojo"
                  outlined
                  v-model="hora_recojo"
                  item-disabled="disabled"
                  required
                ></v-select>
              </v-col>
            </v-row>
          </v-container>
          <v-card-actions>
            <v-btn type="submit" block color="secondary" dark>Enviar lista</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: ["id_user"],
  data: () => ({
    date: '',
    hora_recojo:'',
    modal_calendar: false,
    fecha_ini_calendar:'',
    fecha_fin_calendar:'',
    dialog_productos: false,
    dialog_horario:false,
    buscador: "",
    arrayProductos_n_en_n: [],
    carrito_compras: [],
    arrayCategoria: [],
    arraySubcategoria: [],
    arrayHorario:[],
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
    comprobar_puesto(a, b) {
      let me = this;
      if (b == 0) {
        return true;
      }
      if (me.carrito_compras.length > b + 1) {
        if (a != me.carrito_compras[b + 1].numero_puesto) {
          if(a == me.carrito_compras[b - 1].numero_puesto){
            return false;
          }else{
            return true;
          }
          return true;
        } else if(a != me.carrito_compras[b - 1].numero_puesto) {
          return true;
        }else{
          console.log(a+'ningun if');
          return false;
        }
      } else {
        if (a != me.carrito_compras[b - 1].numero_puesto) {
          return true;
        } else {
          return false;
        }
      }
    },
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
        me.ordenar_carrito();
        me.mostrar_Toast('El producto se ha añadido al carrito');
      } else {
        found.cantidad++;
        me.mostrar_Toast('Se ha agregado una unidad al producto');
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
              found = me.carrito_compras.find(
                element => element.id == me.carrito_compras[producto_index].id
              );
              found.cantidad = 1;
              me.carrito_compras.splice(producto_index, 1);
            }
          });
          break;
      }
    },
    get_horario() {
      if(this.carrito_compras.length>0){
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
            axios.get("api/apiHorario").then(function(response) {
              me.arrayHorario = response.data.data;
              me.date=response.data.fecha_ini;
              me.fecha_ini_calendar=response.data.fecha_ini;
              me.fecha_fin_calendar=response.data.fecha_fin;
            }).catch(function(error) {
              console.log(error);
            });
            let me = this;
            me.dialog_horario=true;
          }
        });
      }else{
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
          icon: "warning",
          title:
            "<p style='font-family: Arial, sans-serif'>No tiene productos agregado al carrito</p>"
        });
      }
    },
    ordenar_carrito(){
      let me =this;
      me.carrito_compras.sort(function(a,b){
        return parseInt(a.numero_puesto) - parseInt(b.numero_puesto);
      });
    },
    cambiar_horarioXfecha(){
      let me=this;
      axios.get('api/apiHorario/'+me.date).then(function(response){
        me.arrayHorario=response.data.data;
      })
    },
    enviar_lista(){
      let me=this;
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
            let lista = me.groupBy(me.carrito_compras, (c) => c.id_comerciante);
            console.log(lista);
            let info = {
              user_id: me.id_user,
              hora: me.hora_recojo,
              total_lista : me.total_carrito
            };
            axios.post("api/apiProductosConsumidor", {
              data_lista: lista,
              info: info
            }).then(function(response) {
              me.dialog_horario=false;
              me.carrito_compras = [];
              me.mostrar_Toast('Se ha enviado la lista correctamente');
            });
          }
        });
    },
    groupBy(xs, f) {
      return xs.reduce((r, v, i, a, k = f(v)) => ((r[k] || (r[k] = [])).push(v), r), {});
    },
    mostrar_Toast(mensaje){
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
          "<p style='font-family: Arial, sans-serif'>"+mensaje+"</p>"
      });
    }
  }
};
</script>
<style>
.txt_puesto{
  font-weight: bold;
  font-size: 1.5rem !important;
  text-decoration-line: underline;
}
</style>