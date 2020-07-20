<template>
  <div>
    <v-toolbar-title class="headline">Reportes de comerciante</v-toolbar-title>
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
