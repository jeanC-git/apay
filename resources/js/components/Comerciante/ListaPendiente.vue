<template>
  <v-card width="100%" height="100%">
    <v-row>
      <v-col cols="12" md="12">
        <v-data-table
          :headers="cabeceras_tabla"
          sort-by="Codigo de pedido"
          class="elevation-1"
          :search="buscador"
          :loading="loading"
          loading-text="Cargando datos..."
          :footer-props="footerProps"
          no-data-text="No hay lista de pedidos para mostrar, verifique sus filtros o intente con otra palabra clave en el buscador."
          :items="array_listas"
        >
          <template v-slot:top>
            <v-container>
              <v-row>
                <v-col cols="12" md="12" xs="12" style="display: flex;align-items: center;">
                  <v-toolbar color="yellow darken-2">
                    <v-toolbar-title class="headline" style="font-size: 1.6rem">LISTA DE PEDIDOS</v-toolbar-title>
                  </v-toolbar>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="4" xs="12">
                  <v-menu
                    v-model="menu2"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        color="green accent-3"
                        v-model="filtro_date"
                        label="Seleccionar fecha"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      color="yellow darken-3"
                      locale="es-419"
                      v-model="filtro_date"
                      @input="menu2 = false,filtro('filtro_date')"
                    ></v-date-picker>
                  </v-menu>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                  <v-select
                    single-line
                    hide-details
                    label="Estado de pedido"
                    color="green accent-3"
                    :items="select_estado"
                    item-text="text"
                    item-value="id"
                    v-model="filtro_select"
                    @change="filtro('filtro_select')"
                  ></v-select>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                  <v-text-field
                    v-model="filtro_text"
                    color="green accent-3"
                    single-line
                    hide-details
                    label="Nombre de cliente"
                    no-data-text="No hay datos disponibles."
                    @input="filtro('filtro_text')"
                  ></v-text-field>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
              </v-row>
            </v-container>
          </template>
          <template v-slot:item.estado_lista="{ item }">
            <v-chip :color="getColorEstado(item.estado_lista)" dark v-text="item.estado_lista"></v-chip>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-tooltip v-model="item.show1" top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  small
                  dense
                  rounded
                  @click="abrir_modal(item)"
                  v-bind="attrs"
                  v-on="on"
                  color="green accent-1"
                >
                  <v-icon small>mdi-eye</v-icon>
                </v-btn>
              </template>
              <span>Ver productos</span>
            </v-tooltip>
            <v-tooltip v-model="item.show2" top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  small
                  dense
                  rounded
                  color="green accent-3"
                  @click="confirmarRecojo(item)"
                  v-bind="attrs"
                  v-on="on"
                >
                  <v-icon small>mdi-check</v-icon>
                </v-btn>
              </template>
              <span>Confirmar recojo</span>
            </v-tooltip>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-dialog v-model="dialog_lista" max-width="600px">
      <v-card>
        <v-card-text>
          <v-simple-table fixed-header height="400px">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">Producto</th>
                  <th class="text-left">Descripción</th>
                  <th class="text-left">Costo(S/.)</th>
                  <th class="text-left">Cantidad</th>
                  <th class="text-left">Empacar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(detalle, index) in array_detalle_lista" :key="index">
                  <td>{{ detalle.nombre }}</td>
                  <td>{{ detalle.descripcion }}</td>
                  <td>{{ detalle.precio }}</td>
                  <td>{{ detalle.cantidad }}</td>
                  <td>
                    <v-switch
                      color="green accent-3"
                      v-model="detalle.estado_switch"
                      :label="getLabelSwitch(detalle.estado_switch)"
                    ></v-switch>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card-text>
        <v-card-actions>
          <v-btn block color="yellow darken-2" @click="Guardar_lista()">Guardar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
export default {
  props: ["id_puesto", "id_comerciante"],
  data: () => ({
    switch2: "",
    select_estado_producto: [
      { text: "Aprobar", id: "1" },
      { text: "Denegar", id: "2" }
    ],
    select_estado: [
      { text: "pendiente", id: "pendiente" },
      { text: "revisado", id: "revisado" }
    ],
    array_listas: [],
    array_detalle_lista: [],
    dialog_lista: false,
    id_item_delete: "",
    rules: {},
    filtro_date: new Date().toISOString().substr(0, 10),
    filtro_text: "",
    filtro_select: "",
    menu2: false,
    newItem: {
      codigo_de_pedido: "",
      cliente: "",
      estado: false,
      total: 0
    },
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
    loading: true,
    buscador: "",
    search: null,
    validar: true,
    modal: false,
    cabeceras_tabla: [
      {
        text: "Codigo de pedido",
        align: "start",
        sortable: true,
        value: "codigo_lista"
      },
      { text: "Cliente", value: "name" },
      { text: "Estado", value: "estado_lista" },
      { text: "Fecha de recojo", value: "fecha_inicio" },
      { text: "Acciones", value: "actions", sortable: false }
    ]
  }),
  mounted() {
    this.get_listas();
  },
  methods: {
    get_listas() {
      let me = this;
      axios
        .get("api/apiComercianteLista/" + me.id_puesto)
        .then(function(response) {
          me.array_listas = response.data.data;
          me.loading = false;
        });
    },
    getColorEstado(estado) {
      if (estado == "PENDIENTE") return "red";
      else if (estado == "REVISADO") return "green";
      else return "green";
    },
    filtro(buscar) {
      let me = this;
      switch (buscar) {
        case "filtro_text":
          me.buscador = me.filtro_text;
          break;
        case "filtro_date":
          let data = {
            date: me.filtro_date,
            id_puesto: me.id_puesto
          };
          axios
            .post("api/apiComercianteLista", { data })
            .then(function(response) {
              me.array_listas = response.data.data;
            });
          break;
        case "filtro_select":
          me.buscador = me.filtro_select;
          break;
        default:
          break;
      }
    },
    abrir_modal(item) {
      let me = this;
      me.dialog_lista = true;
      axios
        .get(
          "api/apiComercianteDetalleLista/" + item.id_lista + ":" + me.id_puesto
        )
        .then(function(response) {
          me.array_detalle_lista = response.data.data;
        });
    },
    getLabelSwitch(estado_switch) {
      return estado_switch ? "Listo" : "Falta";
    },
    Guardar_lista() {
      let me = this;
      Swal.fire({
        title:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>¿Estás seguro de guardar la lista?</p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FDD835",
        cancelButtonColor: "#00E676",
        confirmButtonText:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Aceptar</p>",
        cancelButtonText:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Cancelar</p>"
      }).then(result => {
        if (result.value) {
          let data = me.array_detalle_lista;
          axios
            .post("api/apiComercianteDetalleLista", { data })
            .then(function(response) {
              if (response) {
                me.dialog_lista = false;
                me.array_detalle_lista = [];
                me.mostrar_Toast(
                  "Su lista ha sido procesada correctamente",
                  "success"
                );
                me.get_listas();
              }
            });
        }
      });
    },
    mostrar_Toast(mensaje, tipo_icon) {
      const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: false,
        onOpen: toast => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
      });
      Toast.fire({
        icon: tipo_icon,
        title: "<p style='font-family: Arial, sans-serif'>" + mensaje + "</p>"
      });
    },
    confirmarRecojo(item) {
      let vue = this;
      let listas_estado_2 = [];
      var html = `<p style='font-family: Arial, sans-serif'>No olvide confirmar el <strong>CODIGO DE LISTA</strong> antes de dar en el botón aceptar, solo los productos marcados como <strong>EMPACADOS</strong> se marcarán como recogidos.<br>
      Esta acción no se puede revertir</p>
                `;
      axios
        .get(
          "api/apiComercianteDetalleLista/" +
            item.id_lista +
            ":" +
            vue.id_puesto
        )
        .then(function(response) {
          listas_estado_2 = response.data.data.filter(
            det_listas => det_listas.estado == 2
          );
        });

      Swal.fire({
        title:
          "<p style='font-family: Arial, sans-serif'>¿Está seguro de confirmar el recojo?</p>",
        html: html,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FDD835",
        cancelButtonColor: "#00E676",
        confirmButtonText:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Aceptar</p>",
        cancelButtonText:
          "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Cancelar</p>"
      }).then(result => {
        if (result.value) {
          axios
            .put("api/apiComercianteLista/" + item.id_lista, {
              id_comerciante: vue.id_comerciante,
              id_puesto: vue.id_puesto
            })
            .then(response => {})

            .catch(error => {
              console.log(error);
            });
          Swal.fire({
            title:
              "<p style='font-family: Arial, sans-serif'>Productos recogidos</p>",
            confirmButtonColor: "#FDD835",
            icon: "success",
            confirmButtonText:
              "<p class='font-sacramento' style='font-family: Arial, sans-serif'>Aceptar</p>"
          });
        }
      });
    }
  }
};
</script>
