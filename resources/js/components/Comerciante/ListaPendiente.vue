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
        >
          <template v-slot:top>
            <v-container>
              <v-row>
                <v-col cols="12" md="12" xs="12" style="display: flex;align-items: center;">
                  <v-toolbar color="yellow darken-2">
                  <v-toolbar-title class="headline"   style="font-size: 1.6rem">LISTA DE PEDIDOS</v-toolbar-title>
                  </v-toolbar>  
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="4" xs="12">
                  <v-text-field
                    v-model="search"
                    color="green accent-3"
                    single-line
                    hide-details
                    label="Nombre de cliente"
                    no-data-text="No hay datos disponibles."
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
                 v-model="date"
                 label="Seleccionar fecha"
                 prepend-icon="mdi-calendar"
                 readonly
                 v-bind="attrs"
                 v-on="on"
                 ></v-text-field>
                </template>
                 <v-date-picker color="yellow darken-3" v-model="date" @input="menu2 = false"></v-date-picker>
                </v-menu>
    
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
                <v-col cols="12" md="4" xs="12">
                  <v-select
                    single-line
                    hide-details
                    label="Estado de pedido"
                    color="green accent-3"
                  ></v-select>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-col>
              </v-row>
            </v-container>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-dialog v-model="dialog_delete" width="500">
      <v-card>
        <v-card-title class="headline yellow lighten-2" primary-title>Eliminar producto</v-card-title>
        <v-card-text class="mt-4">¿Esta seguro de eliminar el producto?</v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="dialog_delete = false">Cancelar</v-btn>
          <v-btn color="red lighten-2" text @click="eliminar_producto()">Aceptar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    dialog_delete: false,
    id_item_delete: "",
    rules: {
    },
    date:new Date().toISOString().substr(0, 10),
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
    buscador: null,
    search: null,
    validar: true,
    modal: false,
    cabeceras_tabla: [
      {
        text: "Codigo de pedido",
        align: "start",
        sortable: true,
        value: "Código de pedido"
      },
      { text: "Cliente", value: "cliente" },
      { text: "Estado", value: "estado" },
      { text: "Total(S/.)", value: "precio" },
      { text: "Acciones", value: "actions", sortable: false }
    ],
  }),
  methods: { 
    deleteItem(item) {
      let me = this;
      me.dialog_delete = true;
      me.id_item_delete = item.id;
    },
  }
};
</script>