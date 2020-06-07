<template>
  <v-row align="center" justify="center">
    <!-- CARD DE LOS PUESTOS -->
    <v-card class="mx-auto" max-width="250" v-for="puesto in arrayPuestos" :key="puesto.id">
      <v-img
        class="white--text align-end"
        height="200px"
        src="https://portal.andina.pe/EDPfotografia3/Thumbnail/2018/05/28/000506340W.jpg"
      >
        <v-card-title v-text="puesto.nombre"></v-card-title>
      </v-img>
      <v-card-subtitle class="pb-0" v-text="'Número de puesto :'+puesto.numero"></v-card-subtitle>
      <v-card-text class="text--primary">
        <div v-text="puesto.cellphone"></div>
        <div
          v-text="'Categoria del puesto: ' +puesto.categoria"
        >Whitsunday Island, Whitsunday Islands</div>
      </v-card-text>
      <v-card-actions>
        <v-btn color="orange" text>Compartir</v-btn>
        <v-btn color="orange" text>Ver</v-btn>
      </v-card-actions>
    </v-card>
    <v-card class="mx-auto my-7" max-width="344">
      <v-card-text>
        <p class="display-1 text--primary">¡Registra tu puesto!</p>
        <div class="text--primary d-flex justify-center">
          <v-btn color="pink" fab x-large dark @click="modal_puesto()">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </div>
      </v-card-text>
    </v-card>
    <!-- CARD POR SI NO TIENE PUESTOS CREADO -->

    <!-- MODAL PARA REGISTRAR PUESTO -->
    <v-dialog v-model="dialog_registro" width="500">
      <v-card class="elevation-12" color>
        <v-toolbar color="yellow darken-2" style="display: flex;justify-content: center;">
          <img src="\images\images_comerciante\form.svg" alt />
        </v-toolbar>
        <v-form ref="form" @submit.prevent="registrar_puesto()">
          <v-card-text>
            <v-text-field
              label="Nombre puesto"
              name="nombre_puesto"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-storefront"
              v-model="puesto.nombre_puesto"
              :rules="reglasValidacion.stringRules"
            ></v-text-field>
            <v-text-field
              label="Número de puesto"
              name="numPuesto"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-store-24-hour"
              v-model="puesto.numero_puesto"
              :rules="reglasValidacion.puestoRules"
              :counter="6"
            ></v-text-field>
            <!-- <br /> -->
            <!-- <v-select
              :items="items"
              label="Documento de identidad"
              color="green accent-3"
              dense
              prepend-icon="mdi-numeric"
              mdi-account-box-outline
              v-model="puesto.documento_personal"
              :rules="reglasValidacion.selectRules"
            ></v-select>
            <v-text-field
              label="Digitar el número"
              name="numeroIdentidad"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-number"
              v-model="puesto.numero_documento"
              :rules="reglasValidacion.dniRules"
              :counter="8"
            ></v-text-field>-->
            <v-text-field
              label="Celular"
              name="celular"
              type="value"
              color="green accent-3"
              prepend-icon="mdi-cellphone-android"
              v-model="puesto.celular"
              :rules="reglasValidacion.celularRules"
              :counter="9"
            ></v-text-field>
            <br />
            <v-select
              :items="arrayCategorias"
              label="Categoría"
              color="green accent-3"
              item-text="nombre"
              item-value="id"
              dense
              v-model="puesto.categoria"
              prepend-icon="mdi-storefront"
              :rules="reglasValidacion.selectRules"
            ></v-select>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-flex justify-center>
              <v-btn class="color: yellow darken-2" style="color : #9F9E9D" type="submit">Continuar</v-btn>
            </v-flex>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  props: ["id_user"],
  data: () => ({
    dialog_registro: false,
    arrayCategorias: [],
    numero_de_puestos: "",
    arrayPuestos: [],
    base_url: "",
    puesto: {
      nombre_puesto: "",
      numero_puesto: "",
      celular: "",
      categoria: "",
      id_user: ""
    },
    items: ["DNI", "Numero de pasaporte"],
    categorias: ["Abarrotes", "Frutas", "Verduras"],
    reglasValidacion: {
      dniRules: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras",
        v => v.length <= 8 || "El DNI debe ser no mayor de 8 dígitos"
      ],
      celularRules: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras",
        v =>
          v.length <= 9 || "El número de celular debe ser no mayor de 9 dígitos"
      ],
      puestoRules: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras",
        v =>
          v.length <= 6 || "El número del puesto debe ser no mayor de 6 dígitos"
      ],
      stringRules: [
        v => !!v || "Campo requerido",
        v => /^[A-Z ]+$/i.test(v) || "No se permiten números"
      ],
      numberRules: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras"
      ],
      selectRules: [v => !!v || "Debe seleccionar una opción de la lista"]
    }
  }),
  created() {
    this.puestosXusuario();
  },
  mounted() {
    this.getCategorias();
  },
  methods: {
    getCategorias() {
      let me = this;
      axios
        .get("api/apiCategoria")
        .then(function(response) {
          console.log(response.data.data);
          me.arrayCategorias = response.data.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    registrar_puesto() {
      let me = this;
      let validar = me.$refs.form.validate();
      if (validar) {
        me.puesto.id_user = me.id_user;
        axios
          .post(me.base_url + "/comerciante/registrar_puesto", {
            data: me.puesto
          })
          .then(function(response) {
            me.dialog_registro = false;
            me.puesto.nombre_puesto = "";
            me.puesto.numero_puesto = "";
            me.puesto.celular = "";
            me.puesto.categoria = "";
            me.puestosXusuario();
            Swal.fire({
              icon: "success",
              title:
                "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Puesto registrado</p>"
            });
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
    modal_puesto() {
      let me = this;
      me.dialog_registro = true;
    },
    puestosXusuario() {
      let me = this;
      axios
        .post("comerciante/verificar_puestos", {
          data: me.id_user
        })
        .then(function(response) {
          me.arrayPuestos = response.data.data;
        });
    }
  }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Sacramento&display=swap");

/* .font-sacramento { */
/* font-family: "Sacramento", cursive; */
/* font-size: 3rem; */
/* } */
</style>
