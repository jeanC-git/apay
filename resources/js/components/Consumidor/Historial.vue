<template>
  <v-card width="100%" height="100%">
    <v-row>
      <v-col cols="12" md="12">
        <v-data-table
          :headers="cabeceras_tabla"
          :items="arrayListasConsumidor"
          sort-by="Codigo de pedido"
          class="elevation-1"
          :search="buscador"
          :loading="loading"
          loading-text="Cargando datos..."
          :footer-props="footerProps"
          no-data-text="No hay lista de pedidos para mostrar, verifique la fecha o intente con otra código de lista en el buscador."
        >
          <template v-slot:top>
            <div class="ml-3 mr-3">
              <v-row>
                <v-col cols="12" md="12" xs="12" style="display: flex;align-items: center;">
                  <v-toolbar color="yellow darken-2">
                    <v-toolbar-title
                      class="headline"
                      style="font-size: 1.6rem"
                    >Historial de Listas de Compras</v-toolbar-title>
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
                    readonly
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        color="green accent-3"
                        v-model="date"
                        label="Seleccionar fecha"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        @change="getListasxConsumidor()"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      color="green accent-2"
                      v-model="date"
                      locale="es-419"
                      @input="menu2 = false"
                      @change="getListasxConsumidor()"
                    ></v-date-picker>
                  </v-menu>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>

                <v-col cols="12" md="4" xs="12">
                  <v-text-field
                    v-model="buscador"
                    append-icon="mdi-magnify"
                    color="green accent-3"
                    label="Escribe código..."
                    single-line
                    hide-details
                  ></v-text-field>
                </v-col>
              </v-row>
            </div>
          </template>
          <template v-slot:item.estado="{item }">
            <div class="text-center">
              <v-btn
                class="mx-2 my-2"
                rounded
                color="teal accent-4"
                dark
                small
              >{{ item.pendientes}} pendiente(s)</v-btn>
              <v-btn
                class="mx-2 my-2"
                rounded
                color="green accent-3"
                dark
                small
              >{{ item.aceptados}} aceptado(s)</v-btn>
            </div>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-icon
                  @click="verDetallesxLista(item)"
                  v-bind="attrs"
                  color="green accent-2"
                  v-on="on"
                >mdi-eye</v-icon>
              </template>
              <span>Ver detalles</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-icon
                  @click="cambiarHorario(item)"
                  v-bind="attrs"
                  color="green accent-4"
                  v-on="on"
                >mdi-calendar</v-icon>
              </template>
              <span>Cambiar horario</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-icon v-bind="attrs" color="green accent-3" v-on="on">mdi-delete</v-icon>
              </template>
              <span>Eliminar lista</span>
            </v-tooltip>
          </template>
        </v-data-table>
      </v-col>
    </v-row>

    <!-- MODAL DETALLE LISTAS -->
    <v-dialog v-model="modal_DetalleLista" max-width="50%">
      <v-card>
        <v-card-title class="headline teal--text">
          Lista #{{verlista.id}} - Código : {{verlista.codigo_lista}}
          <v-spacer></v-spacer>
          <v-btn text @click="modal_DetalleLista = false">
            <v-icon color="green accent-3">mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">#</th>
                  <th class="text-left">Producto</th>
                  <th class="text-left">Cantidad</th>
                  <th class="text-left">Puesto - Casero</th>
                  <th class="text-left">Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(detalle, index) in arrayDetallexLista" :key="detalle.det_lista_id">
                  <td>{{ index+1 }}</td>
                  <td>{{ detalle.producto }}</td>
                  <td>{{ detalle.cantidad }} {{detalle.und_medida}}</td>
                  <td>{{ detalle.nombre_puesto }}#{{detalle.num_puesto}} - {{detalle.nom_comerciante}}</td>
                  <td>
                    <div class="text-center">
                      <v-btn
                        rounded
                        :color="detalle.estado == 1 ? '#E8F5E9' : '#00E676'"
                        dark
                      >{{ detalle.estado == 1 ? 'Pendiente' : 'Completo' }}</v-btn>
                    </div>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card-text>
        <!-- <v-card-actions>
          <v-btn block color="green accent-2" type="submit">Guardar</v-btn>
        </v-card-actions>-->
      </v-card>
    </v-dialog>

    <v-dialog v-model="cambiar_horario_dialog" max-width="50%">
      <v-card>
        <v-card-title>Cambiar fecha de recojo</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" lg="12" md="12" sm="12">
              <v-date-picker
                v-model="date"
                full-width
                :landscape="$vuetify.breakpoint.smAndUp"
                class="mt-4"
                :min="date"
                :max="fecha_fin_calendar"
                @change="cambiar_horarioXfecha()"
              ></v-date-picker>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" lg="12" md="12" sm="12">
              <v-select
                :items="arrayHorario"
                color="green accent-2"
                item-text="hora_inicio"
                item-value="id"
                label="Hora de recojo"
                outlined
                v-model="hora_recojo"
                item-disabled="disabled"
                required
              ></v-select>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
export default {
  props: ["id_user"],
  created() {
    let vue = this;
    vue.hoyFecha();

    vue.getListasxConsumidor();
  },
  data: () => ({
    hora_recojo: "",
    arrayHorario: [],
    cambiar_horario_dialog: false,
    modal_DetalleLista: false,
    verlista: [],
    rules: {},
    date: "",
    menu2: false,
    footerProps: {
      itemsPerPageText: "Resultados por página",
      pageText: "",
      itemsPerPageOptions: [5, 10, 15, 20, -1],
      itemsPerPageAllText: "Todos"
    },
    loading: true,
    buscador: "#",
    search: null,
    cabeceras_tabla: [
      {
        text: "Codigo de Lista",
        align: "start",
        sortable: true,
        value: "codigo_lista"
      },
      { text: "Fecha de registro", value: "fecha", align: "center" },
      { text: "Horario de recojo", value: "fecha_recojo", align: "center" },
      { text: "Total(S/.)", value: "total_lista", align: "center" },
      { text: "Estado", value: "estado", align: "center" },
      { text: "Acciones", value: "actions", sortable: false, align: "center" }
    ],
    arrayListasConsumidor: [],
    arrayDetallexLista: [],
    arrayHorario: [],
    fecha_ini_calendar: "",
    fecha_fin_calendar: "",
    date: ""
  }),
  methods: {
    hoyFecha() {
      let vue = this;
      var hoy = new Date();
      var dd = hoy.getDate();
      var mm = hoy.getMonth() + 1;
      var yyyy = hoy.getFullYear();

      dd = vue.agregarCero(dd);
      mm = vue.agregarCero(mm);

      vue.date = yyyy + "-" + mm + "-" + dd;
    },
    agregarCero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },
    deleteItem(item) {
      let me = this;
      me.dialog_delete = true;
      me.id_item_delete = item.id;
    },
    getListasxConsumidor() {
      let vue = this;
      vue.loading = true;

      axios
        .get("api/apiConsumidorLista/" + vue.id_user + ":" + vue.date)
        .then(response => {
          vue.arrayListasConsumidor = response.data.data;
          setTimeout(() => {
            vue.loading = false;
          }, 1000);
        })
        .catch(error => {
          console.log(error);
        });
    },
    verDetallesxLista(item) {
      let vue = this;
      vue.modal_DetalleLista = true;
      vue.verlista = item;
      axios
        .get("api/apiConsumidorDetalleLista/" + vue.verlista.id)
        .then(response => {
          console.log(response.data.data);
          vue.arrayDetallexLista = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    cambiarHorario(item) {
      let vue = this;
      vue.cambiar_horario_dialog = true;
      console.log(item);
      axios
        .get("api/apiHorario")
        .then(response => {
          console.log(response.data);
          vue.arrayHorario = response.data.data;
          vue.date = response.data.fecha_ini;
          vue.fecha_ini_calendar = response.data.fecha_ini;
          vue.fecha_fin_calendar = response.data.fecha_fin;
        })
        .catch(error => {
          console.log(error);
        });
    },
    cambiar_horarioXfecha() {
      let vue = this;
      axios.get("api/apiHorario/" + vue.date).then(function(response) {
        vue.arrayHorario = response.data.data;
      });
    }
  }
};
</script>
