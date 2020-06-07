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
                <v-col cols="12" md="4" xs="12" style="display: flex;align-items: center;">
                  <v-toolbar-title style="font-size: 1.6rem">CONTROL DE PRECIOS</v-toolbar-title>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                  <v-select
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
                    label="Buscador"
                    single-line
                    hide-details
                    @keyup.enter="editarPrecio"
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                  <v-btn color="primary" dark class="mb-2" v-on="on">Nuevo Producto</v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">Agregar producto</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="6">
                          <v-text-field v-model="newItem.nombre" label="Nombre" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                          <v-text-field v-model="newItem.descripcion" label="Descripción" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                          <v-text-field
                            v-model="newItem.precio"
                            :rules="rules.precioRules"
                            label="Precio"
                            required
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
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
                        <v-col cols="12" sm="12" md="6">
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
                        <v-col cols="12" sm="12" md="6">
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
                        <v-col cols="12" sm="12" md="12">
                          <v-file-input
                            show-size
                            chips
                            label="Imagen del producto"
                            v-model="newItem.foto"
                            accept=".jpg, .jpeg, .png"
                          ></v-file-input>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-container>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small @click="abrirModalEdit(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-dialog v-model="modal" max-width="50%">
      <v-card>
        <v-card-title>Editar precio del producto : {{productoEdit.nombre}}</v-card-title>
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
            <v-btn outlined small text @click="modal = false">Cancelar</v-btn>
            <v-spacer></v-spacer>
            <v-btn small color="green accent-2" type="submit">Guardar</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog_delete" width="500">
      <v-card>
        <v-card-title class="headline yellow lighten-2" primary-title>Eliminar producto</v-card-title>

        <v-card-text class="mt-4">¿Esta seguro de eliminar el producto?</v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="dialog_delete = false">Cancelar</v-btn>
          <v-btn color="red lighten-2" text @click="eliminar_producto()">Aceptar</v-btn>
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
      axios.get("/api/apiProducto").then(response => {
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

    save() {
      let vue = this;

      let data = new FormData();
      data.append("data", vue.newItem);

      axios.post("/api/apiProducto", data).then(function(response) {
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
