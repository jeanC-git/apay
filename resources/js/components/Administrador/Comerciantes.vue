<template >
  <v-card width="100%">
    <v-card-title>
      Gestor de comerciantes
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar comerciante"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="calories"
      class="elevation-1"
      :loading="loading"
      loading-text="Cargando datos"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-btn color="green accent-3" dark class="mb-2" v-on="on">Nuevo comerciante</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field v-model="editedItem.name" label="Nombre"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field v-model="editedItem.email" label="Correo"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
      <!-- <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>-->
    </v-data-table>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    loading: true,
    dialog: false,
    headers: [
      {
        text: "Nombres",
        align: "start",
        sortable: false,
        value: "name"
      },
      { text: "Correos", value: "email" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: ""
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Nuevo Comerciante"
        : "Editar Comerciante";
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
    initialize() {
      let me = this;
      this.desserts = [];
      axios
        .get("/lista_comerciantes")
        .then(function(response) {
          let respuesta = response.data;
          me.desserts = respuesta.data;
          me.loading = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
