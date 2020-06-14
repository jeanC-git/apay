<template>
  <v-footer
    dark
    padless
  >
    <v-card
      width="100%"
      flat
      tile
      class="green accent-3 white--text text-center"
    >
      <v-card-text>
        <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-4 white--text"
          icon
        >
          <v-icon size="24px">{{ icon }}</v-icon>
        </v-btn>
      </v-card-text>

      <v-card-text class="white--text pt-0">
      Equipo de Apay para el desarrollo de aplicativos en mercados tradicionales.
      </v-card-text>

      <v-divider color="white"></v-divider>

      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} — <strong>Curso de Integrador</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
  export default {
    data: () => ({
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-linkedin',
        'mdi-instagram',
      ],
    }),
  }
</script>