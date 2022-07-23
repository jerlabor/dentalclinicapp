<template>
         <v-row>
             <v-col cols="12" md="2">
                 <v-card color="primary" dark>
                     <v-card-title>Patients</v-card-title>
                     <v-card-text class="d-flex justify-space-between align-center">
                         <v-icon
                             x-large
                             color="white"
                             class="mr-2"
                         >
                             mdi-account-group
                         </v-icon>
                         <div class="text-h4 font-weight-bold">{{patient_count}}</div>
                     </v-card-text>
                 </v-card>
             </v-col>
         </v-row>
</template>

<script>



import AppLayout from "@/Layouts/AppLayout";

export default {
    layout: AppLayout,
    props: {
        patient_count: {
            required: true,
            type: Number
        }
    },
    components: {
        AppLayout
    }
}
</script>
