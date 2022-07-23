<template>
    <div>
        <v-card class="mb-12" elevation="0">
            <v-card-text>
                <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="600px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                        >
                            Add Treatment
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">Treatment Plan</span>
                        </v-card-title>
                        <v-card-text>
                            <form ref="form">
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-textarea
                                                label="Treatment Process"
                                                clearable
                                                v-model.trim="form.treatment_process"
                                                required
                                            ></v-textarea>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-subheader>Fee</v-subheader>
                                        </v-col>
                                        <v-col cols="8">
                                            <v-text-field
                                                label="Amount"
                                                clearable
                                                type="number"
                                                prefix="₱"
                                                v-model="form.fee"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-subheader>Balance</v-subheader>
                                        </v-col>
                                        <v-col cols="8">
                                            <v-text-field
                                                label="Amount"
                                                clearable
                                                type="number"
                                                prefix="₱"
                                                v-model="form.balance"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeForm"

                            >
                                Close
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="updateOrCreateTreatmentPlan"
                            >
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-data-table
                    :headers="headers"
                    :items="patient.treatment_plans"
                    :items-per-page="10"
                    :sort-by="['created_at']"
                    :sort-desc="[true]"
                    class="elevation-1 mt-5"
                >
                    <template v-slot:item.actions="{ item }">
                        <div class="d-flex">
                            <v-icon
                                small
                                class="mr-2"
                                @click="showUpdateForm(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="true"
                            >
                                mdi-delete
                            </v-icon>
                        </div>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
const formData = {
    treatment_process: '',
    fee: null,
    balance: null,
};
export default {
    name: "PatientMedicalHistory",
    data(){
        return {
            dialog: false,
            form: this.$inertia.form(formData),
            headers: [
                {
                    text: 'Date',
                    align: 'start',
                    value: 'created_at',
                },
                { text: 'Treatment Plan', value: 'treatment_process',width: '70%'},
                { text: 'Fee', value: 'fee' },
                { text: 'Balance', value: 'balance' },
                { text: 'Actions', value: 'actions',sortable: false },
            ]
        }
    },
    props: {
        patient: {
            required: true,
            type: Object
        }
    },
    methods: {
        updateOrCreateTreatmentPlan() {
            if(this.form.hasOwnProperty('id')) this.form.patch(this.route('treatments.update',[this.form.id]))
            else this.form.post(this.route('patients.treatments.store',[this.patient.id]));
            this.resetForm();
        },
        showUpdateForm(item){
            this.form = this.$inertia.form(item)
            this.dialog = true;
        },
        closeForm(){
            this.resetForm();
        },
        resetForm(){
            this.dialog = false;
            this.form = this.$inertia.form(formData);
        }
    }
}
</script>

<style scoped>

</style>
