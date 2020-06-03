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
  </v-card>
</template>


<script>
export default {
  data: () => ({
    rules: {
      precioRules: [
        v => !!v || "Precio es requerido.",
        v => v > 0 || "El precio debe ser mayor a 0."
      ]
    },
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
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
    }
  }
};
</script>
