<template>
  <div>
    <v-btn icon @click="getNotificaciones">
      <v-icon>mdi-bell</v-icon>
    </v-btn>
  </div>
</template>
<script>
export default {
  props: ["id_user"],
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
