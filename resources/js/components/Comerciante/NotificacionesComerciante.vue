<template>
  <div>
    <v-btn icon @click="drawer = !drawer">
      <v-icon>mdi-bell</v-icon>
    </v-btn>
    <v-navigation-drawer
      v-model="drawer"
      :right="right"
      color="#69F0AE"
      :expand-on-hover="expandOnHover"
      absolute
      height="100vh"
    >
      <v-list dense nav class="py-0">
        <v-list-item two-line class="px-0">
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/men/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Application</v-list-item-title>
            <v-list-item-subtitle>Subtext</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
export default {
  props: ["id_user"],
  data() {
    return {
      drawer: false,
      right: true,
      expandOnHover: true,
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Photos", icon: "mdi-image" },
        { title: "About", icon: "mdi-help-box" }
      ]
    };
  },
  created() {
    Echo.private("lista-recibida." + this.id_user).listen(
      "ListaRecibida",
      e => {
        console.log(e);
        // this.getNotificaciones();
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

          //       me.arrayNotificaciones = respuesta.notificaciones;
          //       me.arrayTimeAgo = respuesta.time_ago;
          //       me.count_notificaciones = me.arrayNotificaciones.length;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
