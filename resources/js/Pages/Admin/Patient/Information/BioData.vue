<template>
    <patient-information :patient-id="patient.id">
        <v-card class="mb-12" elevation="0">
            <v-list three-line dense selectable>
                <v-row>
                    <v-col cols="12" md="8">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Name:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.full_name}}</v-list-item-subtitle>
                                <v-list-item-subtitle>
                                    {{ patient.occupation }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Sex:</v-list-item-title>
                                <v-list-item-subtitle>{{this.genderLabel}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Civil Status:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.marital_status.marital_status}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Birth Date:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.birth_date}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Spouse:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.spouse || 'None'}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="3">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Height:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.height + ' cm'}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Weight:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.weight + ' kg'}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Telephone No.:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.telephone}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-content>
                                <v-list-item-title>Mobile No.:</v-list-item-title>
                                <v-list-item-subtitle>{{patient.mobile_no}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-col>
                </v-row>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Address:</v-list-item-title>
                        <v-list-item-subtitle>{{patient.address}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Remarks:</v-list-item-title>
                        <v-list-item-subtitle>{{patient.remarks}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Date Added:</v-list-item-title>
                        <v-list-item-subtitle>{{patient.created_at}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-card>
    </patient-information>
</template>

<script>

import PatientInformation from "@/Layouts/Patient/PatientInformation";

export default {
    name: "BioData",
    components: {
        PatientInformation
    },
    props: {
        patient: {
            type: Object,
            required: true
        }
    },
    computed: {
        genderLabel(){
            return this.patient.gender === 1 ? 'Male' : 'Female';
        }
    }
}
</script>

