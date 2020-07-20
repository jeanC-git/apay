<template>
  <v-card width="100%" height="100%"
    class="overflow-hidden"
    color="grey lighten-2"
    dark
  >
    <v-toolbar
      flat
      color="green accent-3"
    >
      <v-icon>mdi-account</v-icon>
      <v-toolbar-title>Mi Perfil</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        color="green accent-3"
        fab
        small
        @click="isEditing = !isEditing"
      >
        <v-icon v-if="isEditing">mdi-close</v-icon>
        <v-icon v-else>mdi-pencil</v-icon>
      </v-btn>
    </v-toolbar>
    <v-card-text>
      <v-text-field
        :disabled="!isEditing"
        label="Nombres"
        color="green accent-3 red--text"
      ></v-text-field>
      <v-text-field
        :disabled="!isEditing"
        label="Apellidos"
        color="green accent-3"
      ></v-text-field>
      <v-text-field
        :disabled="!isEditing"
        label="Correo electrónico"
        color="green accent-3"
      ></v-text-field>
      <v-text-field
        :disabled="!isEditing"
        label="Contraseña"
        color="green accent-3"
      ></v-text-field>
      <v-text-field
        v-model="password"
        color="green accent-3"
        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.min]"
        :type="show1 ? 'text' : 'password'"
        name="input-10-1"
        label="Contraseña"
        hint="Más de 8 caracteres"
        counter
        @click:append="show1 = !show1"
          ></v-text-field>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn
        :disabled="!isEditing"
        color="green accent-2"
        @click="save"
        block
      >
        Guardar
      </v-btn>
    </v-card-actions>
    <v-snackbar
      v-model="hasSaved"
      :timeout="2000"
      absolute
      bottom
      left
    >
      Tu perfil se actualizó
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    data () {
      return {
        show1: false,
        password: 'Password',
        hasSaved: false,
        isEditing: null,
        model: null,
            rules: {
          required: value => !!value || 'Requerido.',
          min: v => v.length >= 8 || 'Minimo 8 caracteres',
          emailMatch: () => ('El correo electrónico y la contraseña que ingresó no coinciden'),
        },
      }
    },
    methods: {
      customFilter (item, queryText, itemText) {
        const textOne = item.name.toLowerCase()
        const textTwo = item.abbr.toLowerCase()
        const searchText = queryText.toLowerCase()

        return textOne.indexOf(searchText) > -1 ||
          textTwo.indexOf(searchText) > -1
      },
      save () {
        this.isEditing = !this.isEditing
        this.hasSaved = true
      },
    },
  }
</script>