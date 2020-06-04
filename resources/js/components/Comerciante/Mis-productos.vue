<template>
  <v-card width="100%" color="#F5F5F7">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="headline">Gestiona a tus productos:</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-data-table :headers="headers" :items="products">
      <template v-slot:top>
        <v-toolbar>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-spacer></v-spacer>
              <v-btn fab color="yellow darken-1" v-on="on">
                <v-icon dark v-on="on">mdi-plus</v-icon>
              </v-btn>
            </template>
            <v-card color="grey lighten-3">
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green accent-3" text @click="save">
                  <v-icon>mdi-content-save-all</v-icon>
                </v-btn>
                <v-btn color="green accent-3" text @click="close">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
              </v-card-actions>
              <v-card-text>
                <v-container>
                  <v-row>
                    <!-- <v-col cols="12" sm="12" md="12">
                      <v-file-input
                        color="green accent-3"
                        filled
                        prepend-icon="mdi-camera"
                        v-model="editedItem.image"
                        label="Foto"
                      ></v-file-input>
                    </v-col> -->
                    <!-- <v-col cols="12" sm="12" md="12">
                      <v-text-field color="green accent-3" v-model="editedItem.name" label="Nombre"></v-text-field>
                    </v-col> -->
                    <v-col class="d-flex" cols="12" sm="6">
                      <v-select
                        :items="arrayCategorias"
                        label="Categoría"
                        outlined
                        color="green accent-3"
                        item-text="nombre"
                        item-value="id"
                        v-model="editedItem.category"
                        @change="getSubCategorias()"
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
                        v-model="editedItem.subcategory"
                        @change="getProducto()"
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
                        v-model="editedItem.nombre"
                        @change="getPrecioXunidad()"
                      ></v-select>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        color="green accent-3"
                        disabled
                        v-model="editedItem.price"
                        label="Precio"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field color="green accent-3" v-model="editedItem.stock" label="Stock"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon color="yellow darken-1" small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon color="green accent-3" small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  props: ["id_user"],
  data: () => ({
    arrayCategorias: [],
    arraySubcategoria: [],
    arrayProductos:[],
    search: "",
    loading: true,
    dialog: false,
    headers: [
      {
        text: "Nombre",
        align: "start",
        sortable: false,
        value: "name"
      },
      { text: "Imagen", value: "image" },
      { text: "Precio", value: "price" },
      { text: "Stock", value: "stock" },
      { text: "Acciones", value: "actions", sortable: false }
    ],
    products: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      category: "",
      subcategory: "",
      price: "",
      stock: "",
      image: ""
    },
    defaultItem: {
      name: "",
      image: "",
      price: 0.0,
      stock: 0
    }
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo producto" : "Editar producto";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    getProductosXPuesto(){
      let me = this;
      axios.get("api/apiComercianteProductos/"+me.id_user).then(function(response) {
          console.log(response.data.data);
      }).catch(function(error) {
        console.log(error);
      });
    },
    getCategorias() {
      let me = this;
      me.arrayCategorias=[],
      me.arrayProductos=[],
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
      me.arrayProductos=[],
      axios
        .get("api/apiSubCategoria/" + me.editedItem.category)
        .then(function(response) {
          me.arraySubcategoria = response.data.data;
          // console.log(response.data.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    getProducto(){
        let me=this;
        axios.get("api/apiProducto/" + me.editedItem.subcategory)
        .then(function(response) {
          me.arrayProductos = response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    getPrecioXunidad(){
        let me=this;
        axios.get("api/apiUnidadMedida/" + me.editedItem.nombre)
        .then(function(response) {
          console.log(response.data.data.precio);
          me.editedItem.price = response.data.data.precio+' x '+ response.data.data.nombre;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    initialize() {
      let me = this;
      this.products = [];
      axios
        .get("/lista_consumidores")
        .then(function(response) {})
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    editItem(item) {
      // this.editedIndex = this.products.indexOf(item);
      // this.editedItem = Object.assign({}, item);
      // this.dialog = true;
    },
    deleteItem(item) {
      const index = this.products.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.products.splice(index, 1);
    },
    close() {
      // this.dialog = false;
      // this.$nextTick(() => {
      //   this.editedItem = Object.assign({}, this.defaultItem);
      //   this.editedIndex = -1;
      // });
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.editedItem);
      } else {
        this.products.push(this.editedItem);
      }
      this.close();
    }
  },
  mounted() {
    this.getCategorias();
    this.getProductosXPuesto();
  }
};
</script>
