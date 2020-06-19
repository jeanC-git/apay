<template >
  <v-card width="100%">
    <v-card-title class="headline">
      Gestor de comerciantes
      <v-spacer></v-spacer>
      <v-text-field
        v-model="buscador"
        append-icon="mdi-magnify"
        label="Buscar comerciante"
        color="green accent-3"
        single-line
        hide-details
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn rounded class="ma-2" color="yellow darken-1" @click="mostrar_agregar_modal()">
        <v-icon left>mdi-plus</v-icon>Nuevo Comerciante
      </v-btn>
      <v-dialog v-model="modal_nuevo_item" max-width="50%">
        <v-card>
          <v-container>
            <v-card-title class="headline">
              Agregar nuevo comerciante
              <v-spacer></v-spacer>
              <v-btn color="green accent-3" text @click="modal_nuevo_item = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
            <v-form ref="form" @submit.prevent="agregarItem()">
              <v-card-text>
                <v-text-field
                  class="mt-2"
                  label="Nombre(s)"
                  color="green accent-3"
                  append-icon="mdi-alphabetical"
                  v-model="nuevoItem.name"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="Apellidos"
                  color="green accent-3"
                  append-icon="mdi-alphabetical"
                  v-model="nuevoItem.lastname"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="DNI"
                  color="green accent-3"
                  append-icon="mdi-numeric"
                  v-model="nuevoItem.dni"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="Correo electrónico"
                  color="green accent-3"
                  append-icon="mdi-email"
                  v-model="nuevoItem.email"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-btn block color="green accent-2" type="submit">Guardar</v-btn>
              </v-card-actions>
            </v-form>
          </v-container>
        </v-card>
      </v-dialog>
      <v-dialog v-model="modal_edit_item" max-width="50%">
        <v-card>
          <v-container>
            <v-card-title class="headline">
              Editar comerciante
              <v-spacer></v-spacer>
              <v-btn color="green accent-3" text @click="modal_edit_item = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
            <v-form ref="form" @submit.prevent="editarItem()">
              <v-card-text>
                <v-text-field
                  class="mt-2"
                  label="Nombre(s)"
                  color="green accent-3"
                  append-icon="mdi-alphabetical"
                  v-model="editItem.name"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="Apellidos"
                  color="green accent-3"
                  append-icon="mdi-alphabetical"
                  v-model="editItem.lastname"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="DNI"
                  color="green accent-3"
                  append-icon="mdi-numeric"
                  v-model="editItem.dni"
                  required
                ></v-text-field>
                <v-text-field
                  class="mt-2"
                  label="Correo electrónico"
                  color="green accent-3"
                  append-icon="mdi-email"
                  v-model="editItem.email"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-btn block color="green accent-2" type="submit">Guardar</v-btn>
              </v-card-actions>
            </v-form>
          </v-container>
        </v-card>
      </v-dialog>
      <v-dialog v-model="modal_delete_item" max-width="50%">
        <v-card>
          <v-card-title class="headline yellow lighten-2">Eliminar comerciante</v-card-title>
          <v-form ref="form" @submit.prevent="eliminarItem()">
            <v-card-text class="red--text">¿Está seguro de eliminar este comerciante ?</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn text @click="modal_delete_item = false" color="red">No</v-btn>
              <v-btn text color="green accent-3" type="submit">Sí</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-card-title>
    <v-data-table
      color="green accent-3"
      :headers="headers"
      :items="comerciantes"
      sort-by="DNI"
      class="elevation-1"
      :loading="loading"
      loading-text="Cargando datos"
      :search="buscador"
      :footer-props="footerProps"
      no-data-text="No hay comerciantes para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
      no-results-text="No hay comerciantes para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
    >
      <template v-slot:item.name="{ item }">{{item.name}} {{item.lastname}}</template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="mostrar_editar_modal(item)"
          color="yellow darken-1"
        >mdi-pencil</v-icon>
        <v-icon small @click="mostrar_delete_modal(item.id)" color="green accent-4">mdi-delete</v-icon>
      </template>
    </v-data-table>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
    reglas: {
      dni: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras",
        v => v.length <= 8 || "El DNI debe ser no mayor de 8 dígitos"
      ],
      nom_ape: [
        v => !!v || "Campo requerido",
        v => /^[A-Z ]+$/i.test(v) || "No se permiten números"
      ],
      email: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ]
    },
    buscador: "",
    loading: true,
    modal_nuevo_item: false,
    modal_edit_item: false,
    modal_delete_item: false,
    headers: [
      {
        text: "Nombre(s) y Apellidos",
        align: "start",
        sortable: true,
        value: "name"
      },
      { text: "Correos", value: "email" },
      { text: "DNI", value: "dni" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    comerciantes: [],
    nuevoItem: {
      nombre: "",
      apellidos: "",
      email: "",
      dni: ""
    },
    editItem: {
      nombre: "",
      apellidos: "",
      email: "",
      dni: ""
    },
    id_deleteItem: ""
  }),
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      let me = this;
      this.comerciantes = [];
      axios
        .get("/lista_comerciantes")
        .then(function(response) {
          let respuesta = response.data;
          me.comerciantes = respuesta.data;
          me.loading = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    mostrar_agregar_modal() {
      let vue = this;
      vue.modal_nuevo_item = true;
    },
    mostrar_editar_modal(item) {
      let vue = this;
      vue.modal_edit_item = true;
      vue.editItem = item;
    },
    mostrar_delete_modal(id) {
      let vue = this;
      vue.modal_delete_item = true;
      vue.id_deleteItem = id;
    },
    agregarItem() {
      let vue = this;
      let validar = vue.$refs.formnew.validate();
      if (validar) {
        axios
          .post("api/apiComerciante", { data: vue.nuevoItem })
          .then(response => {
            vue.modal_nuevo_item = false;
            vue.nuevoItem = {
              nombre: "",
              apellidos: "",
              email: "",
              dni: ""
            };
            vue.initialize();
          })
          .catch(function(error) {
            // handle error
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
            "<p style='font-family: Arial, sans-serif'>Verifique que todos los campos estén llenos</p>"
        });
      }
    },
    editarItem() {
      let vue = this;
      let validar = vue.$refs.formedit.validate();
      if (validar) {
        axios
          .put("api/apiComerciante/" + vue.editItem.id, {
            data: vue.editItem
          })
          .then(function(response) {
            vue.modal_edit_item = false;
            vue.editItem = {
              nombre: "",
              apellidos: "",
              email: "",
              dni: ""
            };
            vue.initialize();
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
            "<p style='font-family: Arial, sans-serif'>Verifique que todos los campos estén llenos</p>"
        });
      }
    },
    eliminarItem() {
      let vue = this;
      axios
        .delete("api/apiComerciante/" + vue.id_deleteItem)
        .then(response => {
          vue.modal_delete_item = false;
          vue.initialize();
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    }
  }
};
</script>
