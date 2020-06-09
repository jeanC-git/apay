<template>
    <v-container>
        <v-card width="100%">
            <h1 class="ml-2">
                Subida masiva
            </h1>
            <div  class="ml-2">
                <p>Por este medio podras hacer la subida masiva de productos mediante un Excel</p>
            </div>
            <v-file-input show-size counter  label="Suba el archivo" v-model="file"></v-file-input>
            <div class="my-2 pb-2 d-flex justify-center">
                <v-btn depressed large color="primary" @click="SubidaMasiva()">Subir</v-btn>
            </div>
        </v-card>
    </v-container>
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
                console.log(response.data);
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