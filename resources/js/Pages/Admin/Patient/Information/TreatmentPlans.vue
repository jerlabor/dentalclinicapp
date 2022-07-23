<template>
    <patient-information :patient-id="patient.id">
        <confirmation-dialog :value="showConfirmation" @disagree="showConfirmation = false" @confirm="deleteTreatment" title="Delete Treatment Plan">
            <template v-slot:text>Are you sure you want to delete this item?</template>
        </confirmation-dialog>
        <universal-modal :show="dialog" title="Edit Treatment Plan" @save="updateOrCreateTreatmentPlan" @close="closeForm">
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
        </universal-modal>
        <v-card class="mb-12" elevation="0">
            <v-card-text>
                <v-btn
                    color="primary"
                    dark
                    @click="dialog = true"
                >
                    Add Treatment
                </v-btn>
                <v-data-table
                    :headers="headers"
                    :items="patient.treatment_plans"
                    :items-per-page="10"
                    :sort-by="['created_at']"
                    :sort-desc="[true]"
                    class="elevation-1 mt-5"
                >
                    <template v-slot:item.created_at="{item}">
                        {{(new Date(item.created_at)).toDateString()}}
                    </template>
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
                                @click="showDeleteDialog(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </div>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </patient-information>
</template>

<script>
import PatientInformation from "@/Layouts/Patient/PatientInformation";
import ConfirmationDialog from "@/Components/ConfirmationDialog";
import UniversalModal from "@/Components/UniversalModal";

const formData = {
    treatment_process: '',
    fee: null,
    balance: null,
};
export default {
    name: "TreatmentPlans",
    data(){
        return {
            dialog: false,
            showConfirmation: false,
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
    components: {
        PatientInformation,
        ConfirmationDialog,
        UniversalModal
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
        },
        showDeleteDialog(item){
            this.showConfirmation = true;
            this.form = this.$inertia.form(item)
        },
        deleteTreatment(){
            this.form.delete(this.route('treatments.destroy',[this.form.id]))
            this.showConfirmation = false;
            this.resetForm();
        }
    }
}
</script>


