<template>
  <v-row>
    <v-col cols="12" md="4" xs="12">
      <v-card class="mx-auto" max-width="344">
        <v-img
          src="https://www.ngenespanol.com/wp-content/uploads/2018/08/%C2%BFEn-qu%C3%A9-pa%C3%ADs-de-Europa-la-papa-es-un-ingrediente-esencial.jpg"
          height="200px"
        ></v-img>

        <v-card-title>Papa Negra</v-card-title>

        <!-- <v-card-subtitle>1,000 miles of wonder</v-card-subtitle> -->

        <v-card-actions>
          <v-btn text>Agregar</v-btn>

          <!-- <v-btn color="green darken-4" text>Ver más</v-btn> -->

          <v-spacer></v-spacer>

          <v-btn icon @click="show = !show">
            <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
          </v-btn>
        </v-card-actions>

        <v-expand-transition>
          <div v-show="show">
            <v-divider></v-divider>

            <v-card-text>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae, vitae veritatis eius veniam omnis iste nisi distinctio dicta quidem iusto dolorum corrupti enim eaque beatae ea fugit nam quasi debitis.</v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
    <v-col cols="12" md="4" xs="12">
      <v-card class="mx-auto" max-width="344">
        <v-img
          src="https://www.ngenespanol.com/wp-content/uploads/2018/08/%C2%BFEn-qu%C3%A9-pa%C3%ADs-de-Europa-la-papa-es-un-ingrediente-esencial.jpg"
          height="200px"
        ></v-img>

        <v-card-title>Papa Negra</v-card-title>

        <!-- <v-card-subtitle>1,000 miles of wonder</v-card-subtitle> -->

        <v-card-actions>
          <v-btn text>Agregar</v-btn>

          <!-- <v-btn color="green darken-4" text>Ver más</v-btn> -->

          <v-spacer></v-spacer>

          <v-btn icon @click="show2 = !show2">
            <v-icon>{{ show2 ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
          </v-btn>
        </v-card-actions>

        <v-expand-transition>
          <div v-show="show2">
            <v-divider></v-divider>

            <v-card-text>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae, vitae veritatis eius veniam omnis iste nisi distinctio dicta quidem iusto dolorum corrupti enim eaque beatae ea fugit nam quasi debitis.</v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
    <v-col cols="12" md="4" xs="12">
      <v-card class="mx-auto" max-width="344">
        <v-img
          src="https://www.ngenespanol.com/wp-content/uploads/2018/08/%C2%BFEn-qu%C3%A9-pa%C3%ADs-de-Europa-la-papa-es-un-ingrediente-esencial.jpg"
          height="200px"
        ></v-img>

        <v-card-title>Papa Negra</v-card-title>

        <!-- <v-card-subtitle>1,000 miles of wonder</v-card-subtitle> -->

        <v-card-actions>
          <v-btn text>Agregar</v-btn>

          <!-- <v-btn color="green darken-4" text>Ver más</v-btn> -->

          <v-spacer></v-spacer>

          <v-btn icon @click="show3 = !show3">
            <v-icon>{{ show3 ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
          </v-btn>
        </v-card-actions>

        <v-expand-transition>
          <div v-show="show3">
            <v-divider></v-divider>

            <v-card-text>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae, vitae veritatis eius veniam omnis iste nisi distinctio dicta quidem iusto dolorum corrupti enim eaque beatae ea fugit nam quasi debitis.</v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
export default {
  data: () => ({
    show: false,
    show2: false,
    show3: false
  })
};
</script>
