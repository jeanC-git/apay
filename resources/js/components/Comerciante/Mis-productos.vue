<template>
  <v-card width="100%" color="#F5F5F7">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="headline">Gestiona a tus productos:</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-data-table :headers="headers" :items="products">
      <!-- CREAR PRODUCTO -->
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
                <v-btn color="green accent-3" text @click="crearProducto()">
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
                        v-model="newItem.image"
                        label="Foto"
                      ></v-file-input>
                    </v-col> -->
                    <!-- <v-col cols="12" sm="12" md="12">
                      <v-text-field color="green accent-3" v-model="newItem.name" label="Nombre"></v-text-field>
                    </v-col> -->
                    <v-col class="d-flex" cols="12" sm="6">
                      <v-select
                        :items="arrayCategorias"
                        label="Categoría"
                        outlined
                        color="green accent-3"
                        item-text="nombre"
                        item-value="id"
                        v-model="newItem.category"
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
                        v-model="newItem.subcategory"
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
                        v-model="newItem.nombre"
                        @change="getPrecioXunidad()"
                      ></v-select>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        color="green accent-3"
                        disabled
                        v-model="newItem.price"
                        label="Precio"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field color="green   accent-3" v-model="newItem.stock" label="Stock"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <!-- EDITAR PRODUCTO -->
      <template v-slot:top>
        <v-toolbar>
          <v-dialog v-model="dialog_editar" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-spacer></v-spacer>
              <v-btn fab color="yellow darken-1" v-on="on">
                <v-icon dark v-on="on">mdi-plus</v-icon>
              </v-btn>
            </template>
            <v-card color="grey lighten-3">
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green accent-3" text @click="editarProducto()">
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
                        v-model="editItem.category"
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
                        v-model="editItem.subcategory"
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
                        v-model="editItem.nombre"
                        @change="getPrecioXunidad()"
                      ></v-select>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        color="green accent-3"
                        disabled
                        v-model="editItem.price"
                        label="Precio"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field color="green   accent-3" v-model="editItem.stock" label="Stock"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon color="yellow darken-1" small class="mr-2" @click="editarItem(item)">mdi-pencil</v-icon>
        <v-icon color="green accent-3" small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
    <!-- ELIMINAR PRODUCTO -->
    <v-dialog v-model="dialog_delete"
        width="500"
      >
        <v-card>
          <v-card-title
            class="headline yellow lighten-2"
            primary-title
          >
            Eliminar producto
          </v-card-title>
  
          <v-card-text class="mt-4">
           ¿Esta seguro de eliminar el producto?
          </v-card-text>
  
          <v-divider></v-divider>
  
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="green darken-1"
              text
              @click="dialog_delete = false"
            >
              Cancelar
            </v-btn>
            <v-btn
              color="red lighten-2"
              text
              @click="eliminar_producto()"
            >
              Aceptar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
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
    dialog_editar:false,
    dialog_delete:false,
    id_item_delete:'',
    headers: [
      {
        text: "Nombre",
        align: "start",
        sortable: false,
        value: "nombre"
      },
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
      id_user:"",
    },
    editItem: {
      nombre: "",
      category: "",
      subcategory: "",
      price: "",
      stock: "",
      image: "",
      id_user:"",
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
          me.products=response.data.data;
      }).catch(function(error) {
        console.log(error);
      });
    },
    getCategorias() {
      let me = this;
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
        .get("api/apiSubCategoria/" + me.newItem.category)
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
        axios.get("api/apiProducto/" + me.newItem.subcategory)
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
        axios.get("api/apiUnidadMedida/" + me.newItem.nombre)
        .then(function(response) {
          console.log(response.data.data.precio);
          me.newItem.price = 'S/.'+response.data.data.precio+' x '+ response.data.data.nombre;
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
    crearProducto() {
      let vue= this;
      vue.newItem.id_user=vue.id_user;
      axios.post("/api/apiComercianteProductos", {
            data: vue.newItem
      }).then(function(response) {
        vue.getProductosXPuesto();
        vue.dialog=false;
        vue.newItem.name='';
        vue.newItem.stock=0;
        vue.newItem.category='';
        vue.newItem.subcategory='';
        vue.newItem.price='';
        vue.newItem.id_user='';
        Swal.fire({
          icon: "success",
          title:
            "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto agregado.</p>",
          timer: 1700
        });
      })
    },
    deleteItem(item) {
      let me=this;
      me.dialog_delete=true;
      me.id_item_delete=item.id;
    },
    close() {
        let vue=this;
        vue.dialog=false;
        vue.dialog_editar=false;
        vue.newItem.name='';
        vue.newItem.stock=0;
        vue.newItem.category='';
        vue.newItem.subcategory='';
        vue.newItem.price='';
        vue.newItem.id_user='';
        vue.editItem.name='';
        vue.editItem.stock=0;
        vue.editItem.category='';
        vue.editItem.subcategory='';
        vue.editItem.price='';
        vue.editItem.id_user='';
        vue.arraySubcategoria=[];
        vue.arrayProductos=[];
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.newItem);
      } else {
        this.products.push(this.newItem);
      }
      this.close();
    },eliminar_producto(){
      let me=this;
      axios.delete("/api/apiComercianteProductos/"+me.id_item_delete).then(function(response) {
        me.getProductosXPuesto();
        me.dialog_delete=false;
        me.id_item_delete='';
        Swal.fire({
          icon: "success",
          title:
            "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Producto eliminado.</p>",
          timer: 1700
        });
      })
    },editarItem(item){
      console.log(item);
      let vue= this;
        vue.editItem.nombre=item.id_producto;
        vue.editItem.stock=item.stock;
        vue.editItem.category=item.id_categoria;
        vue.editItem.subcategory=item.id_subcategoria;
        vue.editItem.price=item.precio;
        vue.editItem.id_user=item.id_user;
        axios.get("api/apiSubCategoria/" +vue.editItem.category)
        .then(function(response) {
          vue.arraySubcategoria = response.data.data;
        });
        axios.get("api/apiProducto/" + vue.editItem.subcategory)
        .then(function(response) {
          vue.arrayProductos = response.data.data;
        });
        vue.dialog_editar=true;
    }
  },
  mounted() {
    this.getCategorias();
    this.getProductosXPuesto();
  }
};
</script>
