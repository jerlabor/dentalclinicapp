<template>
    <v-card class="mb-12" elevation="0">
        <v-card-title>Medical History</v-card-title>
        <v-card-text>
            <v-form readonly>
                <v-row>
                    <v-col cols="12">
                        <v-radio-group row v-model="patient.medical_history.is_care_of_physician">
                            <template v-slot:label>
                                1. Are you under the care of a Physician?
                            </template>
                            <v-radio
                                label="Yes"
                                :value="1"
                            ></v-radio>
                            <v-radio
                                label="No"
                                :value="0"
                            ></v-radio>
                        </v-radio-group>
                        <template v-if="patient.medical_history.is_care_of_physician">
                            <v-text-field label="Name of Physician" v-model.trim="patient.medical_history.physician.physician_name"></v-text-field>
                            <v-text-field label="Address" v-model.trim="patient.medical_history.physician.address"></v-text-field>
                            <v-text-field label="Contact No." v-model.trim="patient.medical_history.physician.contact_no"></v-text-field>
                            <v-text-field label="Mos. Attended" type="number" v-model.number="patient.medical_history.physician.months_attended"></v-text-field>
                        </template>

                        <v-radio-group row v-model="patient.medical_history.hospitalized">
                            <template v-slot:label>
                                2. Have you been hospitalized?
                            </template>
                            <v-radio
                                label="Yes"
                                :value="1"
                            ></v-radio>
                            <v-radio
                                label="No"
                                :value="0"
                            ></v-radio>
                        </v-radio-group>
                        <v-text-field label="Reason" v-if="patient.medical_history.hospitalized" v-model.trim="patient.medical_history.hospitalized_reason"></v-text-field>

                        <v-radio-group row v-model="patient.medical_history.is_taking_medication">
                            <template v-slot:label>
                                3. Are you presently taking any medication/s?
                            </template>
                            <v-radio
                                label="Yes"
                                :value="1"
                            ></v-radio>
                            <v-radio
                                label="No"
                                :value="0"
                            ></v-radio>
                        </v-radio-group>
                        <v-text-field label="Names of medication/s" v-if="patient.medical_history.is_taking_medication" v-model.trim="patient.medical_history.medications"></v-text-field>

                        <v-radio-group row v-model="patient.medical_history.allergic">
                            <template v-slot:label>
                                4. Are you allergic to any food or drug/medication?
                            </template>
                            <v-radio
                                label="Yes"
                                :value="1"
                            ></v-radio>
                            <v-radio
                                label="No"
                                :value="0"
                            ></v-radio>
                        </v-radio-group>
                        <v-text-field label="Specify" v-if="patient.medical_history.allergic" v-model.trim="patient.medical_history.allergy_details"></v-text-field>

                        <v-radio-group row v-model="patient.medical_history.smoke">
                            <template v-slot:label>
                                5. Do you smoke?
                            </template>
                            <v-radio
                                label="Yes"
                                :value="1"
                            ></v-radio>
                            <v-radio
                                label="No"
                                :value="0"
                            ></v-radio>
                        </v-radio-group>

                        <label class="mt-5 v-label theme--light">6. Please check if you have or have had any of the following:</label>
<!--                                            <v-row dense no-gutters class="px-5">-->
<!--                                                <v-col cols="12" md="3" v-for="illness in patient.patient_illnesses" :key="illness.id">-->
<!--                                                    <v-checkbox-->
<!--                                                        multiple-->
<!--                                                        :label="illness.illness.illness_name"-->
<!--                                                        :value="illness.illness.id"-->
<!--                                                        v-model="patient.patient_illnesses"-->
<!--                                                        :input-value="patient.patient_illnesses.id"-->
<!--                                                    ></v-checkbox>-->
<!--                                                </v-col>-->
<!--                                            </v-row>-->
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
                                                        v-for="item in patient.patient_illnesses.filter(i => i.illness.illness_group === 1)"
                                                        :key="item.id"
                                                    >
                                                        <td>{{ item.illness.illness_name }}</td>
                                                        <td>
                                                            <v-text-field label="Enter Details" v-model.trim="item.illness_details" readonly></v-text-field>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </template>02
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
