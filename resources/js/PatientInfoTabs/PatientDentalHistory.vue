<template>
    <v-card class="mb-12" elevation="0">
        <v-card-title>Dental History</v-card-title>
        <v-card-text>
            <v-form readonly>
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            label="1.What is your immediate dental problem?"
                            v-model.trim="patient.dental_history.dental_problem"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            type="date"
                            label="Date of Last Dental Visit"
                            v-model="patient.dental_history.last_dental_visit"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            label="Previous Dentist"
                            v-model.trim="patient.dental_history.previous_dentist"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="Address of Previous Dentist"
                            v-model.trim="patient.dental_history.address_previous_dentist"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <label class="mt-5 v-label theme--light">2. Please check if you have or have had any of the following:</label>
<!--                        <v-row dense no-gutters class="px-5">-->
<!--                            <v-col cols="12" md="3" v-for="illness in patient.patient_illnesses" :key="illness.id">-->
<!--                                <v-checkbox-->
<!--                                    multiple-->
<!--                                    :label="illness.illness_name"-->
<!--                                    :value="illness"-->
<!--                                    v-model="patient.dental_history.teeth_illnesses"-->
<!--                                    :input-value="patient.dental_history.teeth_illnesses.id"-->
<!--                                ></v-checkbox>-->
<!--                            </v-col>-->
<!--                        </v-row>-->
                        <v-simple-table dense v-if="patient.patient_illnesses.length > 0">
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left" style="width: 20%">
                                        Illness
                                    </th>
                                    <th class="text-left">
                                        Details
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-for="item in patient.patient_illnesses.filter(i => i.illness.illness_group === 2)"
                                    :key="item.id"
                                >
                                    <td>{{ item.illness.illness_name }}</td>
                                    <td>
                                        <v-text-field label="Enter Details" v-model.trim="item.illness_details" readonly></v-text-field>
                                    </td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>


    </v-card>
</template>

<script>
export default {
    name: "PatientMedicalHistory",
    props: {
        patient: {
            required: true,
            type: Object
        }
    }
}
</script>

<style scoped>

</style>
