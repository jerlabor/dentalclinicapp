<template>
  <v-card
    color="primary"
    class="white--text"
  >
    <v-card-title>Add Patient</v-card-title>
    <v-stepper
      v-model="step"
      flat
    >
      <v-stepper-header>
        <v-stepper-step
          :complete="step > 1"
          step="1"
        >
          Biodata
        </v-stepper-step>

        <v-divider />

        <v-stepper-step
          :complete="step > 2"
          step="2"
        >
          Medical History
        </v-stepper-step>

        <v-divider />

        <v-stepper-step step="3">
          Dental History
        </v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content step="1">
          <bio-data @submit="processStepOne" />
        </v-stepper-content>
        <v-stepper-content step="2">
          <medical-history
            @cancel="step-=1"
            @submit="processStepTwo"
          />
        </v-stepper-content>
        <v-stepper-content step="3">
          <dental-history
            @cancel="step-=1"
            @submit="processStepThree"
          />
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-card>
</template>

<script>

import AppLayout from "@/Layouts/AppLayout";
import BioData from "@/Pages/Admin/Patient/Form/BioData";
import MedicalHistory from "@/Pages/Admin/Patient/Form/MedicalHistory";
import DentalHistory from "@/Pages/Admin/Patient/Form/DentalHistory";
export default {
    name: "PatientCreate",
    components: {
        AppLayout,
        BioData,
        MedicalHistory,
        DentalHistory
    },
    layout: AppLayout,
    data(){
        return {
            step: 1,
            form: this.$inertia.form({
                biodata: {},
                medicalHistory: {},
                dentalHistory: {}
            })
        }
    },
    methods:{
        async processStepOne({form,validate}){
            const valid = await validate()
            if(!valid) return
            this.form.biodata = form.data()
            this.step+=1
            // form.post(this.route('patients.store'),{
            //     preserveScroll: true,
            //     onSuccess: () => this.step+=1
            // })
        },
        async processStepTwo({form,validate}){
            const valid = await validate()
            if(!valid) return
            this.form.medicalHistory = form.data()
            this.step+=1
            // this.form.post(this.route('patients.medical-history.store',this.patient.id),{
            //     preserveScroll: true
            // })
        },
        async processStepThree({form,validate}){
            const valid = await validate()
            if(!valid) return
            this.form.dentalHistory = form.data()

            form.processing = true
            this.form.post(this.route('patients.store'),{
                preserveScroll: true,
                onFinish: () => form.processing = false
            })
        }
    }
}
</script>


