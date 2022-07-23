<template>
  <div>
    <v-card class="mb-5">
      <v-card-title>
        Patient Information
      </v-card-title>
      <v-tabs v-model="tab">
        <v-tab>BioData</v-tab>
        <v-tab>Medical History</v-tab>
        <v-tab>Dental History</v-tab>
        <v-tab>Files</v-tab>
        <v-tab>Treatment Plans</v-tab>
      </v-tabs>
    </v-card>
    <v-sheet
      color="white"
      elevation="3"
    >
      <v-tabs-items v-model="tab">
        <v-tab-item>
          <bio-data readonly />
        </v-tab-item>
          <v-tab-item>
              <medical-history readonly />
          </v-tab-item>
          <v-tab-item>
              <dental-history readonly />
          </v-tab-item>
          <v-tab-item>
              <patient-media/>
          </v-tab-item>
          <v-tab-item>
              <treatment-plans/>
          </v-tab-item>
      </v-tabs-items>
    </v-sheet>
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BioData from "@/Pages/Admin/Patient/Form/BioData";
import MedicalHistory from "@/Pages/Admin/Patient/Form/MedicalHistory";
import DentalHistory from "@/Pages/Admin/Patient/Form/DentalHistory";
import PatientMedia from "@/Pages/Admin/Patient/Form/PatientMedia";
import TreatmentPlans from "@/Pages/Admin/Patient/Form/TreatmentPlans";

export default {
    name: "PatientShow",
    components: {
        TreatmentPlans,
        PatientMedia,
        DentalHistory,
        MedicalHistory,
        BioData
    },

    layout: AppLayout,
    props: {
       patient: {
           required: true,
           type: Object
       }
    },
    data () {
        return {
            tab: 0,
            items: [
                {tab: 'Biodata',route: 'patients.bioData'}, {tab: 'Medical History', route: 'patients.bioData'}
            ],
        }
    }
}
</script>

<style scoped>

</style>
