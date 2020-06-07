<template>
  <v-card
    width="100%"
    color="#F5F5F7"
  >
    <v-container>
      <v-row>
      <v-col cols="12" xs="9" sm="10">
        <v-list-item>
            <v-list-item-content>
                <v-list-item-title class="headline">Gestiona a tus productos</v-list-item-title>
            </v-list-item-content>
      </v-list-item>
      </v-col>
      <v-col cols="12" xs="3" sm="2">
        <v-btn icon color="green accent-3">
          <v-icon>mdi-cart</v-icon>
        </v-btn>
      </v-col>
    </v-row>
    </v-container>
    <template v-slot:top>
        <v-card
          max-width="250"
          class="mx-auto"
          color="green accent-3"
        >
          <v-list-item>
            <v-list-item-avatar color="grey"></v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>Nombre del casero</v-list-item-title>
              <v-list-item-subtitle>Num puesto</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-img
            src="https://www.lavanguardia.com/r/GODO/LV/p4/WebSite/2017/05/18/Recortada/img_ysaiz_20160908-162606_imagenes_lv_getty_istock_22114092_small-k7HC-U422720718631MyF-992x558@LaVanguardia-Web.jpg"

          ></v-img>

          <v-card-text>
            <v-list-item two-line>
              <v-list-item-content>
                  <v-list-item-subtitle>Nombre del producto</v-list-item-subtitle>
                  <v-list-item-subtitle>Precio</v-list-item-subtitle>
                  <v-list-item-subtitle>Disponibilidad</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-fab-transition>
              <v-btn
                  color="yellow darken-1"      
                  right
                  fab
                  @click="addToCart"
                >
                <v-icon>mdi-plus</v-icon>
              </v-btn>
            </v-fab-transition>
          </v-card-actions>
        </v-card>
      </template>
  </v-card>
</template>

<script>
export default {
  data: {
    cart:[],
  },
  computed:{
    cartAmount(){
      return this.cart.length
    }
  },
  methods:{
    selectedProduct(){

    },
    addToCart(){
      thi.cart.push(this.selectedProduct)
    }
  }
}
</script>