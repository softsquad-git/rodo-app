<template>
<div>
    <vue-pdf-app :config="config" :page-number="1" style="height: 100vh;" pdf="https://file-examples-com.github.io/uploads/2017/10/file-example_PDF_1MB.pdf"></vue-pdf-app>
</div>
</template>

<script>
import VuePdfApp from "vue-pdf-app";
import "vue-pdf-app/dist/icons/main.css";

export default {
    name: "TrainingBrowserPdfComponent",
    components: {
        VuePdfApp
    },
    data() {
        return {
            config: {
                toolbar: {
                    toolbarViewerLeft: {
                        previous: false
                    }
                },
                isSidebarHidden: false
            },
        }
    }
}
</script>

<style scoped>

</style>
