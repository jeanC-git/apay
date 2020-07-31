<template>
  <div>
    <v-toolbar-title class="headline">Reportes de comerciante</v-toolbar-title>
    <!-- FECHAS -->
    <v-container fluid>
      <v-row>
        <v-col>
          <v-dialog
                ref="dialog"
                color="green accent-3"
                v-model="modal_calendar"
                :return-value.sync="rango_fecha.fecha_inicio"
                persistent
                width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="rango_fecha.fecha_inicio"
                    color="green accent-3"
                    label="Fecha de inicio"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker
                  color="green accent-2"
                  v-model="rango_fecha.fecha_inicio"
                  scrollable
                  locale="es-419"
                >
                <v-spacer></v-spacer>
                <v-btn text color="green accent-2" @click="modal_calendar = false">Cancelar</v-btn>
                <v-btn
                  text
                  color="green accent-3"
                  @click="$refs.dialog.save(rango_fecha.fecha_inicio)"
                >Elegir</v-btn>
              </v-date-picker>
          </v-dialog>
        </v-col>  
        <v-col>
          <v-dialog
                ref="dialog2"
                color="green accent-3"
                v-model="modal_calendar_2"
                :return-value.sync="rango_fecha.fecha_fin"
                persistent
                width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="rango_fecha.fecha_fin"
                    color="green accent-3"
                    label="Fecha fin"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker
                  color="green accent-2"
                  v-model="rango_fecha.fecha_fin"
                  scrollable
                  locale="es-419"
                  :min="rango_fecha.fecha_inicio"
                >
                <v-spacer></v-spacer>
                <v-btn text color="green accent-2" @click="modal_calendar_2 = false">Cancelar</v-btn>
                <v-btn
                  text
                  color="green accent-3"
                  @click="$refs.dialog2.save(rango_fecha.fecha_fin)"
                >Elegir</v-btn>
              </v-date-picker>
          </v-dialog>
        </v-col>
        <v-col>
          <v-btn class="mx-2"  @click="obtener_datos()" fab dark small color="primary">
            <v-icon dark>mdi-table-search</v-icon>
          </v-btn>
        </v-col>
      </v-row>

    </v-container>
    <!-- GRAFICOS -->
    <div class="grafico">
      <h4>Reportes de ventas semanal</h4>
      <v-row>
        <v-col cols="12" lg="6" md="6" sm="6">
          <pie-chart
            :chart-data="datacollection"
            :options="chartOptions"
            :styles="estilos"
            :height="350"
          ></pie-chart>
        </v-col>
        <v-col cols="12" lg="6" md="6" sm="6">
          <bar-chart
            :chart-data="datacollection"
            :options="chartOptions"
            :styles="estilos"
            :height="350"
          ></bar-chart>
        </v-col>
      </v-row>
      <h4>Reportes de ventas mensual</h4>

      <v-row>
        <v-col cols="12" lg="6" md="6" sm="6">
          <line-chart
            :chart-data="datacollection"
            :options="chartOptions"
            :styles="estilos"
            :height="350"
          ></line-chart>
        </v-col>
        <v-col cols="12" lg="6" md="6" sm="6">
          <line-chart
            :chart-data="datacollection"
            :options="chartOptions"
            :styles="estilos"
            :height="350"
          ></line-chart>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
import LineChart from "../ChartJs/LineChart";
import BarChart from "../ChartJs/BarChart";
import PieChart from "../ChartJs/PieChart";

export default {
  components: {
    LineChart,
    BarChart,
    PieChart
  },
  data() {
    return {
      rango_fecha:{
        fecha_inicio:'',
        fecha_fin:'',
      },
      modal_calendar: false,
      modal_calendar_2:false,
      datacollection: {},
      chartOptions: {
        responsive: true
      },
      estilos: {
        position: "relative"
      }
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: [
          "Lunes",
          "Martes",
          "Miercoles",
          "Jueves",
          "Viernes",
          "Sabado",
          "Domingo"
        ],
        datasets: [
          {
            label: "Ventas Lunes",
            backgroundColor: "#FFEE58",
            data: [17, 40, 50, 12, 32, 41]
          },
          {
            label: "Ventas Martes",
            backgroundColor: "#",
            backgroundColor: "#FB8C00",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Miércoles",
            backgroundColor: "#FBC02D",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Jueves",
            backgroundColor: "#424242",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Viernes",
            backgroundColor: "#69F0AE",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Sábado",
            backgroundColor: "#00E676",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Domingo",
            backgroundColor: "#00C853",
            data: [20, 32, 23, 20, 50, 56]
          }
        ]
      };
    },obtener_datos(){
      let me=this;
      axios.post('reportes_ventas',me.rango_fecha).then(function(response){
        
      })
    }
  }
};
</script>

<style lang="css">
.grafico {
  margin: 50px auto;
  max-width: 800px;
}
</style>
