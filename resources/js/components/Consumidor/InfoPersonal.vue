<template>
  <v-card
    width="100%"
    color="#F5F5F7"
  >
    <v-container>
      <v-row>
      <v-col cols="12" xs="9" sm="10">
        <v-list-item>
            <v-list-item-content>
                <v-list-item-title class="headline">Información Personal</v-list-item-title>
            </v-list-item-content>
      </v-list-item>
      </v-col>
      <v-col cols="12" xs="10" sm="2">
      </v-col>
    </v-row>
    </v-container>
    <v-row>
      <template >
        <v-card
          width="450"
          height="550"
          class="mx-auto"
          color="yellow darken-1"
        >
          <v-card-text>
            
            <v-img
            src="https://concepto.de/wp-content/uploads/2018/08/persona-e1533759204552.jpg"
            height="200"
          >
            <v-card class="elevation-12" color="blue">
          </v-img>
            <v-list-item two-line>
              <v-list-item-content>
                  <v-input
                      label="Julio Perez"
                      name="nombre"
                      type="text"
                    >
                    <v-spacer></v-spacer>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-pencil</v-icon>
                     </v-btn>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-archive</v-icon> 
                     </v-btn> 
                  </v-input>
                  <v-input
                      label="Masculino"
                      name="sexo"
                      type="text"
                    >
                    <v-spacer></v-spacer>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-pencil</v-icon>
                     </v-btn>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-archive</v-icon> 
                     </v-btn> 
                  </v-input>
                  <v-input
                      Type="password"
                      label="Contraseña"
                      name="password"
                      
                    >
                    <v-spacer></v-spacer>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-pencil</v-icon>
                     </v-btn>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-archive</v-icon> 
                     </v-btn> 
     
                  </v-input> 


                  <v-input
                      label="juio@gmail.com"
                      name="Correo"
                      type="text"
                    >
                    <v-spacer></v-spacer>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-pencil</v-icon>
                     </v-btn>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-archive</v-icon> 
                     </v-btn> 
                  </v-input>
                  <v-input
                      label="985451158"
                      name="Celular"
                      type="text"
                    >
                    <v-spacer></v-spacer>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-pencil</v-icon>
                     </v-btn>
                     <v-btn align="right"  icon color="green accent-3" type="button"> <v-icon>mdi-archive</v-icon> 
                     </v-btn> 
                  </v-input>
              </v-list-item-content>
            </v-list-item>
          </v-card-text>
        </v-card>
      </template>
    </v-row>
  </v-card>
</template>