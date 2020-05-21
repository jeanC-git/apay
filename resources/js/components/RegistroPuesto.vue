<template>
  <v-row align="center" justify="center">
    <v-col class="mt-0" cols="12" sm="8" md="4">
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
            <br />
            <v-select
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
            ></v-text-field>
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
              :items="categorias"
              label="Categoría"
              color="green accent-3"
              dense
              prepend-icon="mdi-storefront"
              v-model="puesto.categoria"
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
    </v-col>
  </v-row>
</template>
<script>
export default {
  props: ["id_user"],
  data: () => ({
    base_url: "",
    puesto: {
      nombre_puesto: "",
      numero_puesto: "",
      documento_personal: "",
      numero_documento: "",
      celular: "",
      categoria: ""
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
        v => /^[A-Z]+$/i.test(v) || "No se permiten números"
      ],
      numberRules: [
        v => !!v || "Campo requerido",
        v => /^[0-9]+$/i.test(v) || "No se permiten letras"
      ],
      selectRules: [v => !!v || "Debe seleccionar una opción de la lista"]
    }
  }),
  methods: {
    registrar_puesto() {
      let me = this;
      let validar = me.$refs.form.validate();
      if (validar) {
        axios
          .post(me.base_url + "/comerciante/registrar_puesto", {
            data: me.puesto
          })
          .then(function(response) {
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
