<template>
    <app-layout>
        <v-card>
            <v-tabs
                align-with-title
                :value="link"
                hide-slider
            >
                <v-tab
                    v-for="(item,i) in items"
                    :key="i"
                    :href="route(item.route,[patientId])"
                >
                    {{ item.tab }}
                </v-tab>
            </v-tabs>

            <v-card flat>
                <v-card-text>
                    <slot></slot>
                </v-card-text>
            </v-card>
        </v-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "PatientInformation",
    props: {
        patientId: {
            type: Number,
            required: true
        }
    },
    computed:{
        link() {
            return window.location.href
        }
    },
    data () {
        return {
            items: [
                {tab: 'Biodata',route: 'patients.bioData'},
                {tab: 'Medical History', route: 'patients.medicalHistory'},
                {tab: 'Dental History', route: 'patients.dentalHistory'},
                {tab: 'Treatment Plans', route: 'patients.treatmentPlans'},
                {tab: 'Files', route: 'patients.files.index'},
            ],
        }
    },
    components: {
        AppLayout
    }
}
</script>

<style scoped>

</style>
