<template>
  <v-row align="center" justify="center">
    <v-col class="mt-0" cols="12" sm="8" md="4">
      <v-card class="elevation-12" color>
        <v-toolbar color="yellow darken-2" justify-center>
          <img src="\images\images_comerciante\form.svg" alt />
          <v-toolbar-title class="grey--text darken-3">Hola, {{id_user}}</v-toolbar-title>
          <v-spacer></v-spacer>
          <br />
          <v-toolbar-subtitle class="grey--text darken-3">Cuentanos sobre tu negocio</v-toolbar-subtitle>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              label="Nombre puesto"
              name="nombre_puesto"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-storefront"
              v-model="puesto.nombre_puesto"
            ></v-text-field>
            <v-text-field
              label="Número de puesto"
              name="numPuesto"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-store-24-hour"
              v-model="puesto.numero_puesto"
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
            ></v-select>
            <v-text-field
              label="Digitar el número"
              name="numeroIdentidad"
              type="text"
              color="green accent-3"
              prepend-icon="mdi-number"
              v-model="puesto.numero_documento"
            ></v-text-field>
            <v-text-field
              label="Celular"
              name="celular"
              type="value"
              color="green accent-3"
              prepend-icon="mdi-cellphone-android"
              v-model="puesto.celular"
            ></v-text-field>
            <br />
            <v-select
              :items="categorias"
              label="Categoría"
              color="green accent-3"
              dense
              prepend-icon="mdi-storefront"
              v-model="puesto.categoria"
            ></v-select>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex justify-center>
            <v-btn class="color: yellow darken-2" style="color : #9F9E9D">Continuar</v-btn>
          </v-flex>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  props: ["id_user"],
  data: () => ({
    base_url:'',
    puesto:{
      nombre_puesto:'',
      numero_puesto:'',
      documento_personal:'',
      numero_documento:'',
      celular:'',
      categoria:'',
    },
    items: ["DNI", "Numero de pasaporte"],
    categorias: ["Abarrotes", "Frutas", "Verduras"]
  }),
  methods:{
    registrar_puesto(){
      let me=this;
      axios.post(me.base_url + "/comerciante/registrar_producto", {
          nombre_puesto:        me.puesto.nombre_puesto,
          numero_puesto:        me.puesto.numero_puesto,
          documento_personal:   me.puesto.documento_personal,
          numero_documento:     me.puesto.numero_documento,
          celular:              me.puesto.celular,
          categoria:            me.puesto.categoria
      }).then(function(response) {
          
      }).catch(function(error) {
        console.log(error);
      });
    }
  }
};
</script>
