<template>
  <v-app id="inspire">
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
            <v-card class="elevation-12"
                     color="">
              <v-toolbar
                color="yellow darken-1"
                dark
              >
                <v-toolbar-title   class="grey--text darken-3">Registrate</v-toolbar-title>
                <v-spacer></v-spacer>                
                  <v-btn
                  v-for="icon in icons"
                  :key="icon"
                  class="mx-4 white--text"
                  icon  
                  >
                   <v-icon size="40px">{{ icon }}</v-icon>
                  </v-btn>
               </v-toolbar>
               <v-card-text>
                 
                 <v-form>
                    <v-text-field
                      label="Nombre"
                      name="nombre"
                      type="text"
                      color="green accent-3"
                    ></v-text-field>
                    <v-text-field
                      label="Apellido"
                      name="apellido"
                      type="text"
                      color="green accent-3"
                    ></v-text-field>                 
                    <v-text-field
                      label="Correo electrónico"
                      name="login"
                      type="text"
                      color="green accent-3"                  
                    ></v-text-field>
                    <v-text-field
                      id="password"
                      label="Contraseña"
                      name="password"
                      :type="showPassword ? 'text' :'password'"
                      :append-icon="showPassword ? 'mdi-eye' :
                      'mdi-eye-off'"
                      @click:append="showPassword = 
                      !showPassword"
                      color="green accent-3"
                    ></v-text-field>
                    <v-text-field
                      color="green accent-3"
                      id="password"
                      label="Confirmar contraseña"
                      name="validatepassword"
                      :type="showValidatePassword ? 'text' :'password'"
                      :append-icon="showValidatePassword ? 'mdi-eye' :
                      'mdi-eye-off'"
                      @click:append="showValidatePassword = 
                      !showValidatePassword"
                    ></v-text-field>
                 </v-form>
               </v-card-text>
               <v-card-actions >
                <v-flex justify-center>  
                  <div id='example-3'
                    style="text-align:center">
                   <input type="checkbox" id="aceptar" value="Aceptar" v-model="picked">
                   <label>Aceptar términos y condiciones</label>
                   <br>
                  </div>
                </v-flex>
               </v-card-actions>
               <v-card-actions >
                <v-spacer></v-spacer>
                <v-flex justify-center> 
                 <v-btn class= 'color: yellow darken-2'
                 style = 'color : #9F9E9D' 
                 >Continuar</v-btn>
                </v-flex>
               </v-card-actions>           
                <v-flex justify-center class="black--text pt-0">
                  <div id='example-3'
                    style="text-align:center">                  
                   <label>¿Ya tienes cuenta?</label>
                   <br>
                  </div>
                </v-flex>
                <v-card-actions >
                  <v-spacer></v-spacer>
                 <v-flex justify-center> 
                 <v-btn   x-small class= 'color: yellow darken-2'
                 style = 'color : #9F9E9D'>iniciar sesion</v-btn>
                 </v-flex>
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
      showPassword: false,
      showValidatePassword: false
    },
    data: () => ({
      icons: [
        'mdi-facebook-box',
        'mdi-google',
        
      ],
    }),
  }
</script>