<template>
  <v-container>
    <v-row class="d-flex justify-start align-start mx-5" v-if="arrayPuestos==null">
      <!-- TEXTO POR SI NO TIENEN PUESTOS -->
      <div class="mx-4 my-7" max-width="250">
        <p class="display-1 text--primary" v-text="text_info"></p>
      </div>
    </v-row>
    <v-row class="d-flex justify-start align-start mx-5" v-else>
      <!-- CARD POR SI YA TIENE PUESTOS CREADO -->
      <v-tabs
        v-model="tab"
        background-color="green accent-4"
        class="elevation-2"
        dark
        :centered="centered"
        :grow="grow"
        :vertical="vertical"
        :right="right"
        :prev-icon="prevIcon ? 'mdi-arrow-left-bold-box-outline' : undefined"
        :next-icon="nextIcon ? 'mdi-arrow-right-bold-box-outline' : undefined"
        :icons-and-text="icons"
      >
        <v-tabs-slider></v-tabs-slider>

        <v-tab
          v-for="puesto in arrayPuestos"
          :key="puesto.id"
          :href="`#tab-${puesto.id}`"
          v-text="puesto.nombre"
        ></v-tab>
        <v-tab-item v-for="puesto in arrayPuestos" :key="puesto.id" :value="'tab-' + puesto.id">
          <v-card flat tile>
            <productos :id_puesto="puesto.id" :id_comerciante="puesto.id_comerciante"></productos>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-row>
    <!-- MODAL PARA REGISTRAR PUESTO -->
    <v-dialog v-model="dialog_registro" width="500">
      <v-card class="elevation-12">
        <v-toolbar color="yellow darken-2" style="display: flex;justify-content: center;">
          <img src="\images\images_comerciante\form.svg" alt="icono de tienda"/>
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
            <br />
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
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn block color="yellow darken-2" type="submit">Aceptar</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>

    <v-btn bottom color="green accent-3" dark fab fixed right @click="modal_puesto()">
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-container>
</template>
<script>
import productos from "./Mis-productos.vue";
export default {
  components: {
    productos
  },
  props: ["id_user"],
  data() {
    return {
      text_info: "¡Registra tu puesto dandole click al (+)!",
      tab: null,
      icons: false,
      centered: false,
      grow: false,
      vertical: false,
      prevIcon: false,
      nextIcon: false,
      right: false,
      tabs: 3,
      dialog_registro: false,
      arrayCategorias: [],
      mostrar_registro: false,
      arrayPuestos: null,
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
          v => v.length <= 8 || "El DNI no debe ser mayor de 8 dígitos"
        ],
        celularRules: [
          v => !!v || "Campo requerido",
          v => /^[0-9]+$/i.test(v) || "No se permiten letras",
          v =>
            v.length <= 9 ||
            "El número de celular no debe ser mayor de 9 dígitos"
        ],
        puestoRules: [
          v => !!v || "Campo requerido",
          v => /^[0-9]+$/i.test(v) || "No se permiten letras",
          v =>
            v.length <= 6 ||
            "El número del puesto debe ser no mayor de 6 dígitos"
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
    };
  },
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
          //   console.log(response.data.data);
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
          if (response.data.data.length > 0) {
            me.arrayPuestos = response.data.data;
          }
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