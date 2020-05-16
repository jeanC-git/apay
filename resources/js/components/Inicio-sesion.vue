<template>
  <v-col cols="s12" md="12">
      <form
    style="width:50%"
    >
    <v-text-field
      v-model="name"
      :counter="10"
      label="Nombre"
      required    
    ></v-text-field>
    <v-text-field
      v-model="email"
      label="Correo electrónico"
      required
    ></v-text-field>
    <v-select
      v-model="select"
      :items="items"
      label="Perfil"
      required
    ></v-select>
    <v-checkbox
      v-model="checkbox"
      label="Acepto terminos y condiciones"
      required
    ></v-checkbox>
    <v-btn class="mr-4">Ingresar</v-btn>
  </form>
  </v-col>
</template>


<script>
  export default {
    data: () => ({
      name: '',
      email: '',
      select: null,
      items: [
        'Consumidor',
        'Comerciante',
      ],
      checkbox: false,
    }),
  }
</script>