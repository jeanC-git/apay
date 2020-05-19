<template>
  <v-app id="inspire" style='background-image:url("https://i.ibb.co/xFT2W9F/banner.jpg");background-size: cover;background-position:center;background-repeat: no-repeat;'>
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="mt-0"
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="yellow darken-1"
                dark
                flat
              >
                <v-toolbar-title class="grey--text darken-3">Iniciar Sesión</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      :href="source"
                      icon
                      large
                      target="_blank"
                      v-on="on"
                    >
                      
                    </v-btn>
                  </template>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    color="green accent-1"
                    label="Correo electrónico"
                    name="login"
                    type="text"
                    prepend-icon="mdi-account-circle"
                  ></v-text-field>

                  <v-text-field
                    color="green accent-1"
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
                <v-btn class="grey--text darken-3" flat color="yellow darken-1" >Registrarse</v-btn>
                <v-spacer></v-spacer>
                <v-btn class="grey--text darken-3" flat color="yellow darken-1">Ingresar</v-btn>
                  
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
 
</template>
<script>
  export default {
    props: {
      source: String,
      showPassword: false
    },
  }
</script>