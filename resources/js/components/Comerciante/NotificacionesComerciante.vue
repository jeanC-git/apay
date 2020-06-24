<template>
  <div>
    <v-btn icon class="mr-2" @click="drawer = !drawer; getNotificaciones()">
      <v-badge
        color="yellow accent-4"
        :content="notificaciones.length >0 ? notificaciones.length : '0' "
        :value="notificaciones.length >0 ? notificaciones.length : '0' "
        transition="slide-x-transition"
      >
        <v-icon>mdi-bell</v-icon>
      </v-badge>
    </v-btn>

    <v-navigation-drawer
      v-model="drawer"
      :right="right"
      color="#69F0AE"
      :expand-on-hover="false"
      absolute
      height="100vh"
    >
      <v-list dense nav class="py-0">
        <v-list-item two-line class="px-0">
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/men/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{consumidor_data.name}} {{consumidor_data.lastname}}</v-list-item-title>
            <v-list-item-title>{{consumidor_data.email}}</v-list-item-title>
          </v-list-item-content>
          <v-btn icon @click="drawer = !drawer">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item v-for="notificacion in notificaciones" :key="notificacion.id" link>
          <v-list-item-icon>
            <v-icon>mdi-clipboard-check</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ notificacion.mensaje }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
export default {
  props: ["id_user", "user_data"],
  data() {
    return {
      consumidor_data: "",
      drawer: false,
      right: true,
      expandOnHover: true,
      notificaciones: []
    };
  },
  created() {
    this.consumidor_data = JSON.parse(this.user_data);
    this.getNotificaciones();
    Echo.private("lista-recibida." + this.id_user).listen(
      "ListaRecibida",
      e => {
        this.getNotificaciones();
      }
    );
  },
  methods: {
    getNotificaciones() {
      let vue = this;
      axios
        .get("api/apiNotificaciones/" + vue.id_user)

        .then(function(response) {
          var respuesta = response.data;

          vue.notificaciones = respuesta.data;
          //       me.arrayTimeAgo = respuesta.time_ago;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
