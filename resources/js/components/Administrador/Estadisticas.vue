<template>
  <div class="grafico">
    <h4>Reportes del Venta Junio</h4>
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
        <line-chart
          :chart-data="datacollection"
          :options="chartOptions"
          :styles="estilos"
          :height="350"
        ></line-chart>
      </v-col>
    </v-row>
    <h4>Reportes del Venta Junio</h4>

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
            label: "Ventas Junio",
            backgroundColor: "#FF0066",
            data: [17, 40, 50, 12, 32, 41]
          },
          {
            label: "Ventas Mayo",
            backgroundColor: "#FF9066",
            data: [20, 32, 23, 20, 50, 56]
          },
          {
            label: "Ventas Abril",
            backgroundColor: "#F29066",
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
