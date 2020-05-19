<template>
  <v-container>
    <div class="">
    <template>
      <v-card>
        <v-navigation-drawer
          permanent
          expand-on-hover
        >
          <v-list>
            <v-list-item class="px-2">
              <v-list-item-avatar>
                <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
              </v-list-item-avatar>
            </v-list-item>

            <v-list-item link>
              <v-list-item-content>
                <v-list-item-title>Lesly</v-list-item-title>
                <v-list-item-subtitle>lesly@hotmail.com</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <v-divider></v-divider>

          <v-list
            color="green accent-2"
            nav
            dense
          >
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-account-multiple</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Información personal</v-list-item-title>
            </v-list-item>
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-folder</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Listas de compras</v-list-item-title>
            </v-list-item>
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-star</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Favoritos</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>
      </v-card>
    </template>
  </div>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      consumidores: [
        { nombre: 'lesly samaritano', correo: 'lesly.selene.96@gmail.com'},
        { nombre: 'lesly samaritano ayala', correo: 'lesly.selene.96@gmail.com'},
      ],
    }),
  }
</script>