<template>
  <v-card
    max-width="344"
    class="mx-auto"
    color="green accent-3"
  >
    <v-list-item>
      <v-list-item-avatar color="grey"></v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="headline">Nombre del casero</v-list-item-title>
        <v-list-item-subtitle>Num puesto</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg"
      height="100"
    ></v-img>

    <v-card-text>
      <ul>
        <li>Nombre del producto</li>
        <li>Precio</li>
        <li>Disponibilidad</li>
      </ul>
      <v-fab-transition>
          <v-btn
              color="yellow darken-1"    
              top      
              right
              fab
              >
              <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-fab-transition>
    </v-card-text>
  </v-card>
</template>