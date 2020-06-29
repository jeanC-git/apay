<template>
  <div>
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
                    <v-date-picker color="yellow darken-3" v-model="filtro_date" @input="menu2 = false,filtro('filtro_date')"></v-date-picker>
                  </v-menu>
                    <v-divider class="mx-4" inset vertical></v-divider>
                  </v-col>
                  <v-col cols="12" md="4" xs="12">
                    <v-select
                      single-line
                      hide-details
                      label="Estado de pedido"
                      color="green accent-3"
                      :items='select_estado'
                      item-text="text"
                      item-value="id"
                      v-model="filtro_select"
                      @change="filtro('filtro_select')"
                    ></v-select>
                    <v-divider class="mx-4" inset vertical></v-divider>
                  </v-col>
                </v-row>
              </v-container>
            </template>
            <template v-slot:item.estado_lista="{ item }">
              <v-chip :color="getColorEstado(item.estado)" dark v-text="item.estado_lista"></v-chip>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon small @click="abrir_modal(item)">mdi-eye</v-icon>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script>
export default {
  props: ["id_puesto", "id_comerciante"],
  data: () => ({
    select_estado:[{text: "pendiente",id :"pendiente"},{ text :"revisado",id:"revisado"}],
    array_listas:[],
    dialog_lista: false,
    id_item_delete: "",
    rules: {
    },
    filtro_date:new Date().toISOString().substr(0, 10),
    filtro_text:'',
    filtro_select:'',
    menu2: false,
    newItem: {
      codigo_de_pedido: "",
      cliente: "",
      estado: false,
      total: 0,
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
    ],
  }),
  mounted() {
    this.get_listas();
  },
  methods: { 
    get_listas(){
      let me=this;
      axios.get('api/apiComercianteLista/'+me.id_puesto).then(function(response){
        console.log();
        // me.array_listas=[];
        // me.array_listas=response.data.data;
        me.array_listas=response.data.data;
        me.loading=false;
        console.log(me.array_listas);
      })
    },getColorEstado(estado){
        if (estado == 1) return 'red'
        else if (estado == 2) return 'green'
        else return 'green'
    },filtro(buscar){
      let me= this;
      switch (buscar) {
        case 'filtro_text':
            me.buscador=me.filtro_text;
          break;
        case 'filtro_date':
            me.buscador=me.filtro_date;
          break
        case 'filtro_select':
            me.buscador=me.filtro_select;
            break
        default:
          break;
      }
    },abrir_modal(){
      let me=this;
      me.dialog_lista=true;
    }
  }
};
</script>