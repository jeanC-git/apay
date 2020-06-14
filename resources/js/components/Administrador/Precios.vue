<template>
  <v-card width="100%" height="100%">
    <v-row>
      <v-col cols="12" md="12">
        <v-data-table
          :headers="cabeceras_tabla"
          :items="productos"
          sort-by="nombre"
          class="elevation-1"
          :search="buscador"
          :loading="loading"
          loading-text="Cargando datos..."
          :footer-props="footerProps"
          no-data-text="No hay productos para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
        >
          <template v-slot:top>
            <v-container>
              <v-row>
                <v-col cols="12" md="4" xs="12">
                  <v-toolbar-title class="headline">Control de precios</v-toolbar-title>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="4" xs="12">
                  <v-select
                    color="green accent-3"
                    v-model="search"
                    single-line
                    hide-details
                    label="Categoría"
                    no-data-text="No hay datos disponibles."
                  ></v-select>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                  <v-text-field
                    v-model="buscador"
                    append-icon="mdi-magnify"
                    color="green accent-3"
                    label="Buscador"
                    single-line
                    hide-details
                    @keyup.enter="editarPrecio"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                </v-col>
              </v-row>
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                  <v-btn rounded color="yellow darken-1" class="mb-2" v-on="on"><v-icon left>mdi-plus</v-icon>Nuevo Producto</v-btn>
                </template>
                <v-card>
                  <v-container>
                    <v-card-title>
                      <span class="headline">Agregar producto</span>
                      <v-spacer></v-spacer>
                      <v-btn color="green accent-3" text @click="close"><v-icon>mdi-close</v-icon></v-btn>
                    </v-card-title>
                    <v-card-text>
                      <v-row>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-text-field v-model="newItem.nombre" label="Nombre" required color="green accent-3"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-text-field v-model="newItem.descripcion" label="Descripción" required color="green accent-3"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-text-field
                            v-model="newItem.precio"
                            :rules="rules.precioRules"
                            label="Precio"
                            required
                            color="green accent-3" 
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-select
                            :items="arrayMedidas"
                            label="Unidad de medida"
                            outlined
                            color="green accent-3"
                            item-text="nombre"
                            item-value="id"
                            v-model="newItem.id_und_medida"
                            required
                          ></v-select>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-select
                            :items="arrayCategorias"
                            label="Categoría"
                            outlined
                            color="green accent-3"
                            item-text="nombre"
                            item-value="id"
                            v-model="newItem.id_categoria"
                            @change="getSubCategorias()"
                            required
                          ></v-select>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="ma-0">
                          <v-select
                            :items="arraySubcategoria"
                            label="SubCategoría"
                            item-text="nombre"
                            item-value="id"
                            outlined
                            color="green accent-3"
                            v-model="newItem.id_subcategoria"
                            required
                          ></v-select>
                        </v-col>
                        <v-col cols="12" sm="12" md="12" class="ma-0">
                          <v-file-input
                            show-size                        
                            label="Foto del producto"
                            @change="validarImagen"
                            color="green accent-3"
                          >
                          </v-file-input>
                          <!--<input type="file" @change="validarImagen" />-->
                        </v-col>
                      </v-row>
                    </v-card-text>
                    <v-card-actions>
                      <v-btn block color="green accent-2" class="ma-0" @click="save">Guardar</v-btn>
                    </v-card-actions>
                  </v-container>
                </v-card>
              </v-dialog>
            </v-container>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small @click="abrirModalEdit(item)" color="yellow darken-1">mdi-pencil</v-icon>
            <v-icon small @click="deleteItem(item)" color="green accent-4">mdi-delete</v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-dialog v-model="modal" max-width="50%">
      <v-card>
        <v-card-title class="headline">Editar precio del producto : {{productoEdit.nombre}}
          <v-spacer></v-spacer>
          <v-btn text @click="modal = false"><v-icon>mdi-close</v-icon></v-btn>
        </v-card-title>
        <v-form ref="form" @submit.prevent="editarPrecio()">
          <v-card-text>
            <v-text-field
              class="mt-2"
              label="Precio (Nuevos Soles)"
              color="green accent-3"
              :rules="rules.precioRules"
              append-icon="mdi-numeric"
              v-model="productoEdit.precio"
              required
            ></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="green accent-2" type="submit">Guardar</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog_delete" width="500">
      <v-card>
        <v-card-title class="headline" primary-title>Eliminar producto</v-card-title>
        <v-card-text class="red--text">¿Esta seguro de eliminar el producto?</v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outlined small text color="yellow darken-1" @click="dialog_delete = false">No</v-btn>
          <v-btn small color="green accent-2" @click="eliminar_producto()">Sí</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    dialog_delete: false,
    id_item_delete: "",
    rules: {
      precioRules: [
        v => !!v || "Precio es requerido.",
        v => v > 0 || "El precio debe ser mayor a 0."
      ]
    },
    newItem: {
      nombre: "",
      descripcion: "",
      precio: 0,
      id_subcategoria: "",
      id_categoria: "",
      id_und_medida: "",
      foto: null
    },
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
    arrayCategorias: [],
    arraySubcategoria: [],
    arrayMedidas: [],
    loading: true,
    buscador: null,
    search: null,
    validar: true,
    modal: false,
    cabeceras_tabla: [
      {
        text: "Producto",
        align: "start",
        sortable: true,
        value: "nombre"
      },
      { text: "Categoría", value: "categoria" },
      { text: "Subcategoría", value: "subcategoria" },
      { text: "Medida", value: "medida" },
      { text: "Precio (S/.)", value: "precio" },
      { text: "Acciones", value: "actions", sortable: false }
    ],
    productos: [],
    editedIndex: -1,
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    productoEdit: ""
  }),
  created() {
    this.getProductos();
  },
  mounted() {
    this.getCategorias();
    this.getUnidadMedida();
  },
  methods: {
    getProductos() {
      let vue = this;
      vue.loading = true;
      axios.get("/0/apiProducto").then(response => {
        vue.productos = response.data.data;
        setTimeout(() => {
          vue.loading = false;
        }, 1500);
      });
    },
    getUnidadMedida() {
      let vue = this;
      axios
        .get("/api/apiUnidadMedida")
        .then(response => {
          vue.arrayMedidas = response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    getCategorias() {
      let me = this;
      axios
        .get("api/apiCategoria")
        .then(function(response) {
          me.arrayCategorias = response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    getSubCategorias() {
      let me = this;
      axios
        .get("api/apiSubCategoria/" + me.newItem.id_categoria)
        .then(function(response) {
          me.arraySubcategoria = response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    abrirModalEdit(item) {
      let vue = this;
      vue.modal = true;
      vue.productoEdit = item;
    },
    editarPrecio() {
      let vue = this;
      let validar = vue.$refs.form.validate();
      vue.loading = true;
      if (validar) {
        axios
          .put("/api/apiProducto/" + vue.productoEdit.id, {
            data: vue.productoEdit
          })
          .then(function(response) {
            vue.getProductos();
            Swal.fire({
              icon: "success",
              title:
                "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Precio actualizado.</p>",
              timer: 1700
            });
            setTimeout(() => {
              vue.modal = false;
              vue.loading = false;
            }, 1700);
          })
          .catch(function(error) {
            console.log(error);
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
            "<p style='font-family: Arial, sans-serif'>Verifique que todos los campos estén llenados correctamente.</p>"
        });
      }
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    validarImagen(e) {
      let fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);
      fileReader.onload = e => {
        this.newItem.foto = e.target.result;
      };
    },
    save() {
      let vue = this;
      axios
        .post("/api/apiProducto", { data: vue.newItem })
        .then(function(response) {
          vue.getProductos();
          vue.dialog = false;
          vue.newItem.nombre = "";
          vue.newItem.descripcion = "";
          vue.newItem.precio = 0;
          vue.newItem.id_subcategoria = "";
          vue.newItem.id_categoria = "";
          vue.newItem.id_und_medida = "";
          vue.newItem.foto = null;
          Swal.fire({
            icon: "success",
            title:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto agregado.</p>",
            timer: 1700
          });
        });
    },
    deleteItem(item) {
      let me = this;
      me.dialog_delete = true;
      me.id_item_delete = item.id;
    },
    eliminar_producto() {
      let me = this;
      axios
        .delete("/api/apiProducto/" + me.id_item_delete)
        .then(function(response) {
          me.getProductos();
          me.dialog_delete = false;
          me.id_item_delete = "";
          Swal.fire({
            icon: "success",
            title:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto eliminado.</p>",
            timer: 1700
          });
        });
    }
  }
};
</script>
