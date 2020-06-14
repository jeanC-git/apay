<template>
    <v-responsive>
        <v-card width="100%">
        <v-container>
            <v-row>
                <v-col cols="12" xs="12" md="12">
                    <v-card-title class="headline">Subida masiva</v-card-title>
                </v-col>
                <v-col cols="12" xs="12" md="12">
                    <v-card-text>
                        <p>Por este medio podras hacer la subida masiva de productos mediante un Excel</p>
                        <v-file-input show-size label="Suba el archivo" v-model="file" color="green accent-3"></v-file-input>
                    </v-card-text>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" xs="12" md="12">
                    <v-card-actions>
                        <v-btn block color="green accent-2" @click="SubidaMasiva()">
                            <v-icon>mdi-arrow-up-bold</v-icon> Subir
                        </v-btn>
                    </v-card-actions>
                </v-col>
            </v-row>
        </v-container>
    </v-card>   
    </v-responsive>
</template>
<script>
export default {
    data() {
        return {
            file:null,
        }
    },methods: {
        SubidaMasiva() {
        let vue = this;
        let archivo = vue.file;
        let extension = archivo.name.split(".");
        if (extension[1] == "xls") {
            let data = new FormData();
            data.append("archivo", archivo);
            axios
            .post("/subida_excel", data)
            .then(response => {
                Swal.fire(
                'Se han subido correctamente todos los productos',
                '',
                'success'
                )
            })
        } else {
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: false,
            customClass: {
                container: "font-Arial"
            },
            showClass: {
                popup: "animateanimated animatefadeInRight"
            },
            hideClass: {
                popup: "animateanimated animatefadeOutRight"
            },
            onOpen: toast => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
        });

        Toast.fire({
          icon: "error",
          title: "Solo se permiten los formatos: .jpg, .jpeg y .png"
        });
      }
    },
    },
}
</script>