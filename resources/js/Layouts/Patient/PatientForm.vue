<template>
    <div>
        <v-subheader class="text-h4 my-3">{{ isUpdate ? 'Update' : 'Create'}} Patient's Record</v-subheader>
        <v-stepper :value="e1">
            <!--Header-->
            <v-stepper-header>
                <v-stepper-step
                    :complete="e1 > 1"
                    step="1"
                >
                    Biodata
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step
                    :complete="e1 > 2"
                    step="2"
                >
                    Medical History
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step step="3">
                    Dental History
                </v-stepper-step>
            </v-stepper-header>
            <!--Forms-->
            <v-stepper-items>
                <slot/>
            </v-stepper-items>
        </v-stepper>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "PatientForm",
    layout: AppLayout,
    props: {
        patient: {
            required:false,
            type: Object
        }
    },
    data(){
        return {
            e1: this.$page.props.step
        }
    },
    computed: {
        isUpdate(){
            return !!this.patient
        }
    },
    methods: {
        updateStep(){
            console.log('test')
        }
    },
    components: {
        AppLayout
    }
}
</script>

<style scoped>

</style>
