<template>
  <v-card width="100%" color="#F5F5F7">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="headline">Gestiona a tus productos</v-list-item-title>
      </v-list-item-content>
      <v-btn rounded color="yellow darken-1" @click="abrir_modal_crear()">
        <v-icon dark>mdi-plus</v-icon>Añadir alimento
      </v-btn>
    </v-list-item>
    <template></template>
    <v-data-table :headers="headers" :items="products">
      <template v-slot:item.actions="{ item }">
        <v-icon color="yellow darken-1" small class="mr-2" @click="editarItem(item)">mdi-pencil</v-icon>
        <v-icon color="green accent-3" small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
    <!-- EDITAR PRODUCTO -->
    <v-dialog v-model="dialog_editar" max-width="500px">
      <v-card color="grey lighten-3">
        <v-form ref="form_edit" @submit.prevent="editarProducto()">
          <v-card-actions>
            <v-spacer></v-spacer>
              <v-btn color="green accent-3" text type="submit">
                <v-icon>mdi-content-save-all</v-icon>
              </v-btn>
              <v-btn color="green accent-3" text @click="close">
                <v-icon>mdi-close</v-icon>
              </v-btn>
          </v-card-actions>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col class="d-flex" cols="12" sm="6">
                  <v-select
                    :items="arrayCategorias"
                    label="Categoría"
                    outlined
                    color="green accent-3"
                    item-text="nombre"
                    item-value="id"
                    :disabled="disable_select"
                    v-model="editItem.category"
                    @change="getSubCategorias('edit')"
                  ></v-select>
                </v-col>
                <v-col class="d-flex" cols="12" sm="6">
                  <v-select
                    :items="arraySubcategoria"
                    label="Sub-Categoría"
                    item-text="nombre"
                    item-value="id"
                    outlined
                    color="green accent-3"
                    v-model="editItem.subcategory"
                    :disabled="disable_select"
                    @change="getProducto('edit')"
                  ></v-select>
                </v-col>
                <v-col class="d-flex" cols="12" sm="6">
                  <v-select
                    :items="arrayProductos"
                    label="Nombre del producto"
                    item-text="nombre"
                    item-value="id"
                    outlined
                    color="green accent-3"
                    v-model="editItem.nombre"
                    :disabled="disable_select"
                    @change="getPrecioXunidad('edit')"
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    color="green accent-3"
                    disabled
                    class="black--text"
                    v-model="editItem.descripcion"
                    label="Descripción del producto"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    color="green accent-3"
                    disabled
                    class="red--text"
                    v-model="editItem.price"
                    label="Precio"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    color="green accent-3"
                    v-model="editItem.stock"
                    :rules="reglas.stock"
                    :counter="4"
                    label="Stock"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
        </v-form>
      </v-card>
    </v-dialog>
    <!-- CREAR -->
    <v-dialog v-model="dialog" max-width="500px">
      <v-card color="grey lighten-3">
        <v-form ref="form" @submit.prevent="crearProducto()">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" color="green accent-3" text>
              <v-icon>mdi-content-save-all</v-icon>
            </v-btn>
            <v-btn color="green accent-3" text @click="close">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-actions>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col class="d-flex" cols="12" sm="6" md="6">
                  <v-select
                    :items="arrayCategorias"
                    label="Categoría"
                    outlined
                    color="green accent-3"
                    item-text="nombre"
                    item-value="id"
                    v-model="newItem.category"
                    :rules="reglas.select"
                    @change="getSubCategorias('crear')"
                  ></v-select>
                </v-col>
                <v-col class="d-flex" cols="12" sm="6" md="6">
                  <v-select
                    :items="arraySubcategoria"
                    label="Sub-Categoría"
                    item-text="nombre"
                    item-value="id"
                    outlined
                    color="green accent-3"
                    v-model="newItem.subcategory"
                    @change="getProducto('crear')"
                    :rules="reglas.select"
                  ></v-select>
                </v-col>
                <v-col class="d-flex" cols="12" sm="12" md="12">
                  <v-select
                    :items="arrayProductos"
                    label="Nombre del producto"
                    item-text="nombre"
                    item-value="id"
                    outlined
                    color="green accent-3"
                    v-model="newItem.nombre"
                    :rules="reglas.select"
                    item-disabled="disable_select"
                    @change="getPrecioXunidad('crear')"
                  ></v-select>
                </v-col>
                <hr />
                <v-col cols="12" sm="12" md="12">
                  <p class="h4 text-center" style="font-size:2rem">{{newItem.price}}</p>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    color="green   accent-3"
                    v-model="newItem.stock"
                    label="Stock"
                    :rules="reglas.stock"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
        </v-form>
      </v-card>
    </v-dialog>
    <!-- ELIMINAR PRODUCTO -->
    <v-dialog v-model="dialog_delete" width="500">
      <v-card>
        <v-card-title class="headline yellow lighten-2" primary-title>Eliminar producto</v-card-title>
        <v-card-text class="mt-4 red--text">¿Esta seguro de eliminar el producto?</v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" text @click="dialog_delete = false">No</v-btn>
          <v-btn color="green accent-3" text @click="eliminar_producto()">Sí</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  props: ["id_puesto", "id_comerciante"],
  data() {
    return {
      disable_select:true,
      arrayCategorias: [],
      arraySubcategoria: [],
      arrayProductos: [],
      search: "",
      loading: true,
      dialog: false,
      dialog_editar: false,
      dialog_delete: false,
      id_item_delete: "",
      headers: [
        {
          text: "Nombre",
          align: "start",
          sortable: false,
          value: "nombre"
        },
        { text: "Descripcion", value: "descripcion" },
        { text: "Categoria", value: "categoria" },
        { text: "Subcategoria", value: "subcategoria" },
        { text: "Precio (S/.)", value: "precio" },
        { text: "Unidad", value: "unidad" },
        { text: "Stock", value: "stock" },
        { text: "Acciones", value: "actions", sortable: false }
      ],
      products: [],
      editedIndex: -1,
      newItem: {
        name: "",
        category: "",
        subcategory: "",
        price: "",
        stock: "",
        image: "",
        id_puesto: "",
        id_comerciante: "",
        descripcion: ""
      },
      editItem: {
        id: "",
        nombre: 0,
        category: 0,
        subcategory: 0,
        price: "",
        stock: "",
        image: "",
        id_puesto: "",
        id_comerciante: "",
        descripcion: ""
      },
      reglas: {
        stock: [
          v => !!v || "Campo requerido",
          v => /^[0-9]+$/i.test(v) || "No se permiten letras",
          v => v > 0 || "El stock no puede ser 0 o un valor negativo.",
          v => v <= 2000 || "Máximo se pueden agregar 2000 unidades x producto.",
        ],
        select: [v => !!v || "Debe seleccionar una opción de la lista"]
      }
    };
  },
  methods: {
    getProductosXPuesto() {
      let me = this;
      axios
        .get("api/apiComercianteProductos/" + me.id_puesto)
        .then(function(response) {
          me.products = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getCategorias() {
      let me = this;
      me.arrayProductos = [];
      axios
        .get("api/apiCategoria")
        .then(function(response) {
          me.arrayCategorias = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getSubCategorias($tipo) {
      let me = this;
      let $id_categoria =
      $tipo == "edit" ? me.editItem.category : me.newItem.category;
      me.resetear_variable("edit_categoria");
      axios
        .get("api/apiSubCategoria/" + $id_categoria)
        .then(function(response) {
          me.arraySubcategoria = response.data.data;
        });
    },
    getProducto($tipo) {
      let me = this;
      let $id_subcategoria =
      $tipo == "edit" ? me.editItem.subcategory : me.newItem.subcategory+':'+me.id_puesto;
      me.resetear_variable("edit_subcategoria");
      axios.get("api/apiProducto/" + $id_subcategoria).then(function(response) {
        me.arrayProductos = response.data.data;
      });
    },
    getPrecioXunidad($tipo) {
      let me = this;
      let $id_producto =
        $tipo == "edit" ? me.editItem.nombre : me.newItem.nombre;
      axios
        .get("api/apiUnidadMedida/" + $id_producto)
        .then(function(response) {
          if ($tipo == "edit") {
            me.editItem.descripcion = response.data.data.descripcion;
            me.editItem.price =
              response.data.data.prodNom +
              " - S/." +
              response.data.data.precio +
              " x " +
              response.data.data.nombre;
          } else {
            me.newItem.descripcion = response.data.data.descripcion;
            me.newItem.price =
              response.data.data.descripcion +
              " - S/." +
              response.data.data.precio +
              " x " +
              response.data.data.nombre;
          }
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    crearProducto() {
      let vue = this;
      let validar = vue.$refs.form.validate();
      vue.newItem.id_puesto = vue.id_puesto;
      vue.newItem.id_comerciante = vue.id_comerciante;

      if (validar) {
        axios
          .post("/api/apiComercianteProductos", {
            data: vue.newItem
          })
          .then(function(response) {
            vue.getProductosXPuesto();
            vue.dialog = false;
            vue.newItem.name = "";
            vue.newItem.stock = 0;
            vue.newItem.category = "";
            vue.newItem.subcategory = "";
            vue.newItem.price = "";
            vue.newItem.id_puesto = "";
            Swal.fire({
              icon: "success",
              title:
                "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto agregado.</p>",
              timer: 1700
            });
          });
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top",
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
            "<p style='font-family: Arial, sans-serif'>Verifique que todos los campos estén llenos</p>"
        });
      }
    },
    deleteItem(item) {
      let me = this;
      me.dialog_delete = true;
      me.id_item_delete = item.id;
    },
    close() {
      let vue = this;
      vue.dialog = false;
      vue.dialog_editar = false;
      vue.newItem.name = "";
      vue.newItem.stock = 0;
      vue.newItem.category = "";
      vue.newItem.subcategory = "";
      vue.newItem.price = "";
      vue.newItem.id_puesto = "";
      vue.editItem.name = "";
      vue.editItem.stock = 0;
      vue.editItem.category = "";
      vue.editItem.subcategory = "";
      vue.editItem.price = "";
      vue.editItem.id_puesto = "";
      vue.arraySubcategoria = [];
      vue.arrayProductos = [];
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.newItem);
      } else {
        this.products.push(this.newItem);
      }
      this.close();
    },
    eliminar_producto() {
      let me = this;
      axios
        .delete("/api/apiComercianteProductos/" + me.id_item_delete)
        .then(function(response) {
          me.getProductosXPuesto();
          me.dialog_delete = false;
          me.id_item_delete = "";
          Swal.fire({
            icon: "success",
            title:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto eliminado.</p>",
            timer: 1700
          });
        });
    },
    editarItem(item) {
      let vue = this;
      vue.editItem.id = item.id;
      vue.editItem.stock = item.stock;
      vue.editItem.category = parseInt(item.id_categoria);
      vue.editItem.price = "S/." + item.precio + " x " + item.unidad;
      vue.editItem.id_puesto = vue.id_puesto;
      vue.editItem.id_comerciante = vue.id_comerciante;
      vue.editItem.descripcion = item.descripcion;
      axios.get("api/apiSubCategoria/" + item.id_categoria)
        .then(function(response) {
          vue.arraySubcategoria = response.data.data;
          vue.editItem.subcategory = parseInt(item.id_subcategoria);
        });
      axios.get("api/apiProducto/" + item.id_subcategoria)
      .then(function(response) {
        vue.arrayProductos = response.data.data;
        vue.editItem.nombre = parseInt(item.id_producto);
      });
        vue.dialog_editar = true;
    },
    abrir_modal_crear() {
      let me = this;
      me.newItem.category = "";
      me.newItem.price = "";
      me.newItem.stock = "";
      me.arraySubcategoria = [];
      me.arrayProductos = [];
      me.dialog = true;
    },
    editarProducto() {
      let vue = this;
      let validar = vue.$refs.form_edit.validate();
      if(validar){
        axios.put("/api/apiComercianteProductos/" + vue.editItem, {
            data: vue.editItem
        }).then(function(response) {
            vue.editItem.id = "";
            vue.editItem.name = "";
            vue.editItem.stock = 0;
            vue.editItem.category = "";
            vue.editItem.subcategory = "";
            vue.editItem.price = "";
            vue.editItem.id_puesto = "";
            vue.getProductosXPuesto();
            vue.dialog_editar = false;
            Swal.fire({
              icon: "success",
              title:
                "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto editado.</p>",
              timer: 1700
            });
          });
      }else{
        const Toast = Swal.mixin({
          toast: true,
          position: "top",
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
            "<p style='font-family: Arial, sans-serif'>Verifique que todos los campos estén llenos y cumplan con lo requerido</p>"
        });
      }
    },
    resetear_variable(key) {
      let me = this;
      me.editItem.descripcion = "";
      me.editItem.price = "";
      switch (key) {
        case "edit_subcategoria":
          me.arrayProductos = [];
          break;
        case "edit_categoria":
          me.arraySubcategoria = [];
          me.arrayProductos = [];
          break;
        default:
          break;
      }
    }
  },
  mounted() {
    this.getCategorias();
    this.getProductosXPuesto();
  }
};
</script>
