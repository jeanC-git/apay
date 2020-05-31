<template>
  <v-card
    width="100%"
    color="#F5F5F7"
  >
    <v-list-item>
            <v-list-item-content>
                <v-list-item-title class="headline">Gestiona a tus productos</v-list-item-title>
            </v-list-item-content>
    </v-list-item>
    <template >
      <v-card
        max-width="250"
        class="mx-auto"
        color="green accent-3"
      >
        <v-list-item>
          <v-list-item-avatar color="grey"></v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>Nombre delll casero</v-list-item-title>
            <v-list-item-subtitle>Num puesto</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-img
          src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg"
          height="100"
        ></v-img>

        <v-card-text>
          <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-subtitle>Nombre del producto</v-list-item-subtitle>
                <v-list-item-subtitle>Precio</v-list-item-subtitle>
                <v-list-item-subtitle>Disponibilidad</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-fab-transition>
            <v-btn
                color="yellow darken-1"      
                right
                fab
                >
                <v-icon>mdi-plus</v-icon>
            </v-btn>
            </v-fab-transition>
        </v-card-actions>
      </v-card>
    </template>
  </v-card>
</template>