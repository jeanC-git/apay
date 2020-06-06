<template>
  <v-app
    id="inspire"
    style="background-image:url('https://i.ibb.co/xFT2W9F/banner.jpg');background-size: cover;background-position:center;background-repeat: no-repeat;"
  >
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center" v-show="mostrar_iniciar">
          <v-col class="mt-0" cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="yellow darken-1" dark flat>
                <v-toolbar-title class="grey--text darken-3">Iniciar Sesión</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Correo electrónico"
                    name="login"
                    type="text"
                    prepend-icon="mdi-account-circle"
                    color="green accent-3"
                  ></v-text-field>

                  <v-text-field
                    color="green accent-3"
                    id="password"
                    label="Contraseña"
                    name="password"
                    :type="showPassword ? 'text' :'password'"
                    prepend-icon="mdi-lock"
                    :append-icon="showPassword ? 'mdi-eye' :
                    'mdi-eye-off'"
                    @click:append="showPassword =
                    !showPassword"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions outline tile>
                <v-spacer></v-spacer>
                <v-btn text
                  class="color: yellow darken-2"
                  style="color : #9F9E9D"
                  @click="cambiar_registro">
                  Registrarse
                  </v-btn>
                <v-spacer></v-spacer>
                <v-btn class="color: yellow darken-2" style="color : #9F9E9D">Ingresar</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
        <RegistroInicio v-show="mostrar_registro"></RegistroInicio>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
import RegistroInicio from "./Registro";
export default {
  data() {
    return {
      mostrar_registro: false,
      mostrar_iniciar: true
    };
  },
  props: {
    source: String,
    showPassword: false
  },
  components: {
    RegistroInicio
  },
  methods: {
    cambiar_registro() {
      this.mostrar_registro = true;
      this.mostrar_iniciar = false;
    }
  }
};
</script>
