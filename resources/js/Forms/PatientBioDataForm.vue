<template>
    <!--Content-->
    <div>
        <v-subheader class="text-h4 my-3">{{ isUpdate ? 'Update' : 'Create'}} Patient's Record</v-subheader>
        <v-stepper v-model="e1">
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
                <v-stepper-content step="1">
                    <ValidationObserver v-slot="{ invalid }">
                        <v-card class="mb-12" elevation="0">
                            <v-form>
                                <v-row>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="First Name *"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.first_name"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Middle Name *"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.middle_name"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Last Name *"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.last_name"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            label="Suffix"
                                            v-model.trim="form.biodata.suffix"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Birth Date *"
                                                type="date"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.birth_date"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-select
                                                :items="[{gender: 'Male' ,id:1},{gender: 'Female' ,id:0}]"
                                                label="Sex *"
                                                item-text="gender"
                                                item-value="id"
                                                :error-messages="errors"
                                                v-model="form.biodata.gender"
                                                required
                                            ></v-select>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-select
                                                :items="marital_statuses"
                                                label="Civil Status *"
                                                item-text="marital_status"
                                                item-value="id"
                                                :error-messages="errors"
                                                v-model="form.biodata.marital_status_id"
                                                required
                                            ></v-select>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            label="Occupation"
                                            type="text"
                                            v-model.trim="form.biodata.occupation"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" v-if="form.biodata.marital_status_id === 2">
                                            <v-text-field
                                                label="Spouse"
                                                type="text"
                                                v-model.trim="form.biodata.spouse"
                                            ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            label="Telephone"
                                            type="text"
                                            v-model.trim="form.biodata.telephone"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Mobile No. *"
                                                type="text"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.mobile_no"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Address *"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.address"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Height (cm)"
                                                type="number"
                                                :error-messages="errors"
                                                v-model.number="form.biodata.height"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Weight (kg)"
                                                type="number"
                                                :error-messages="errors"
                                                v-model.number="form.biodata.weight"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                    <v-col cols="12">
                                        <validation-provider rules="required" v-slot="{ errors }">
                                            <v-text-field
                                                label="Remarks"
                                                :error-messages="errors"
                                                v-model.trim="form.biodata.remarks"
                                                required
                                            ></v-text-field>
                                        </validation-provider>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card>
                        <Link
                            class="ma-1"
                            color="grey"
                            plain
                            as="button"
                            type="button"
                            :href="route('patients.index')"
                        >
                            Back
                        </Link>
                        <v-btn
                            color="primary"
                            @click="e1 = 2"
                            :disabled="invalid"
                        >
                            Continue
                        </v-btn>
                    </ValidationObserver>
                </v-stepper-content>
                <v-stepper-content step="2">
                    <ValidationObserver v-slot="{ invalid }">
                        <v-card class="mb-12" elevation="0">
                            <v-form>
                                <v-row>
                                    <v-col cols="12">
                                        <v-radio-group row v-model="form.medicalHistory.is_care_of_physician">
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
                                        <template v-if="form.medicalHistory.is_care_of_physician">
                                            <v-text-field label="Name of Physician" v-model.trim="form.medicalHistory.physician.physician_name"></v-text-field>
                                            <v-text-field label="Address" v-model.trim="form.medicalHistory.physician.address"></v-text-field>
                                            <v-text-field label="Contact No." v-model.trim="form.medicalHistory.physician.contact_no"></v-text-field>
<!--                                            TODO add month validation-->
                                            <v-text-field label="Mos. Attended" type="number" v-model.number="form.medicalHistory.physician.months_attended"></v-text-field>
                                        </template>

                                        <v-radio-group row v-model="form.medicalHistory.hospitalized">
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
                                        <v-text-field label="Reason" v-if="form.medicalHistory.hospitalized" v-model.trim="form.medicalHistory.hospitalized_reason"></v-text-field>

                                        <v-radio-group row v-model="form.medicalHistory.is_taking_medication">
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
                                        <v-text-field label="Names of medication/s" v-if="form.medicalHistory.is_taking_medication" v-model.trim="form.medicalHistory.medications"></v-text-field>

                                        <v-radio-group row v-model="form.medicalHistory.allergic">
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
                                        <v-text-field label="Specify" v-if="form.medicalHistory.allergic" v-model.trim="form.medicalHistory.allergy_details"></v-text-field>

                                        <v-radio-group row v-model="form.medicalHistory.smoke">
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
                                        <v-row dense no-gutters class="px-5">
                                            <v-col cols="12" md="3" v-for="illness in medicalIllnesses" :key="illness.id">
                                                <v-checkbox
                                                    multiple
                                                    :label="illness.illness_name"
                                                    :value="illness"
                                                    v-model="form.medicalHistory.patient_illnesses"
                                                    :input-value="form.medicalHistory.patient_illnesses.id"
                                                ></v-checkbox>
                                            </v-col>
                                        </v-row>
                                        <v-simple-table dense v-if="form.medicalHistory.patient_illnesses.length > 0">
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
                                                    v-for="illness in form.medicalHistory.patient_illnesses"
                                                    :key="illness.id"
                                                >
                                                    <td>{{ illness.illness_name }}</td>
                                                    <td>
                                                        <v-text-field label="Enter Details" v-model.trim="illness.details"></v-text-field>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </template>
                                        </v-simple-table>

                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card>

                        <v-btn
                            color="primary"
                            @click="e1 = 3"
                        >
                            Continue
                        </v-btn>

                        <v-btn
                            text
                            @click="e1 = e1 - 1"
                        >
                            Back
                        </v-btn>
                    </ValidationObserver>
                </v-stepper-content>
                <v-stepper-content step="3">
                    <ValidationObserver v-slot="{ invalid }">
                        <v-card
                            class="mb-12"
                            elevation="0"
                        >
                            <v-form>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="1.What is your immediate dental problem?"
                                            v-model.trim="form.dentalHistory.dental_problem"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            type="date"
                                            label="Date of Last Dental Visit"
                                            v-model="form.dentalHistory.last_dental_visit"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            label="Previous Dentist"
                                            v-model.trim="form.dentalHistory.previous_dentist"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Address of Previous Dentist"
                                            v-model.trim="form.dentalHistory.address_previous_dentist"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <label class="mt-5 v-label theme--light">2. Please check if you have or have had any of the following:</label>
                                        <v-row dense no-gutters class="px-5">
                                            <v-col cols="12" md="3" v-for="illness in teethIllnesses" :key="illness.id">
                                                <v-checkbox
                                                    multiple
                                                    :label="illness.illness_name"
                                                    :value="illness"
                                                    v-model="form.dentalHistory.teeth_illnesses"
                                                    :input-value="form.dentalHistory.teeth_illnesses.id"
                                                ></v-checkbox>
                                            </v-col>
                                        </v-row>
                                        <v-simple-table dense v-if="form.dentalHistory.teeth_illnesses.length > 0">
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
                                                    v-for="illness in form.dentalHistory.teeth_illnesses"
                                                    :key="illness.id"
                                                >
                                                    <td>{{ illness.illness_name }}</td>
                                                    <td>
                                                        <v-text-field label="Enter Details" v-model.trim="illness.details"></v-text-field>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </template>
                                        </v-simple-table>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card>
                        <v-btn
                            color="primary"
                            @click="submit"

                        >
                            Save
                            <template v-slot:loader>
                                <span class="custom-loader">
                                  <v-icon light>mdi-cached</v-icon>
                                </span>
                            </template>
                        </v-btn>
                        <v-btn
                            @click="e1 = e1 - 1"
                            text
                        >
                            Back
                        </v-btn>
                    </ValidationObserver>
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import { ValidationObserver, ValidationProvider, extend } from 'vee-validate';
import { required,email } from 'vee-validate/dist/rules';


extend('required', {
    ...required,
    message: 'This field is required'
});

extend('email', {
    ...email,
    message: 'Email must be valid',
});

export default {
    name: "PatientBioDataForm",
    props: {
        patient: {
            required: false
        }
    },
    computed: {
        isUpdate(){
            return !!this.patient;
        },
        teethIllnesses(){
            return this.illnesses.filter(illness => illness.illness_group === 2);
        },
        medicalIllnesses(){
            return this.illnesses.filter(illness => illness.illness_group === 1);
        }
    },
    data: function() {
        return {
            form: this.$inertia.form({
                biodata: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    suffix: '',
                    birth_date: '',
                    gender: null,
                    marital_status_id:'',
                    occupation: '',
                    spouse: '',
                    telephone: '',
                    mobile_no: '',
                    address: '',
                    height: '',
                    weight: '',
                    remarks: ''
                },
                medicalHistory:{
                    is_care_of_physician: null,
                    hospitalized: null,
                    hospitalized_reason: '',
                    is_taking_medication: null,
                    medications: '',
                    allergic: null,
                    allergy_details: '',
                    smoke: null,
                    patient_illnesses: [],
                    physician: {
                        physician_name: '',
                        address: '',
                        months_attended: null,
                        contact_no: ''
                    }
                },
                dentalHistory: {
                    dental_problem: '',
                    last_dental_visit: null,
                    previous_dentist: '',
                    address_previous_dentist: '',
                    teeth_illnesses: []
                }
            }),
            e1: 1,
            illnesses: [],
            marital_statuses: []
        }
    },
    methods: {
        submit() {
            this.form.submit(this.isUpdate ? 'patch' : 'post',this.isUpdate ? this.route('patients.update',[this.patient.id]) : this.route('patients.store'));
        },
        // async fetchFormData() {
        //    let [illnesses,marital_statuses] = await Promise.all([Illness.$get(),MaritalStatus.$get()]);
        //    this.illnesses = illnesses;
        //    this.marital_statuses = marital_statuses;
        // }
    },
    created(){
        this.fetchFormData();
    },
    mounted() {
        if(this.patient) {
            Object.assign(this.form.biodata,this.patient);
            Object.assign(this.form.medicalHistory,this.patient.medical_history);
            // this.form.medicalHistory.patient_illnesses = this.patient.medical_history.patient_illnesses.map(ill => ill.illness_id);
        }
    },
    components:{
        Link,
        ValidationProvider,
        ValidationObserver
    }
}
</script>

<style>
.custom-loader {
    animation: loader 1s infinite;
    display: flex;
}
@-moz-keyframes loader {
    from {
        transform: rotate(0);
    }
    to {
        transform: rotate(360deg);
    }
}
@-webkit-keyframes loader {
    from {
        transform: rotate(0);
    }
    to {
        transform: rotate(360deg);
    }
}
@-o-keyframes loader {
    from {
        transform: rotate(0);
    }
    to {
        transform: rotate(360deg);
    }
}
@keyframes loader {
    from {
        transform: rotate(0);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
