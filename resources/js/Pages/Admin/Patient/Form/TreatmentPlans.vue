<template>
  <v-card>
    <confirm-dlg ref="confirm" />
    <v-card-title>
      <v-spacer />
      <v-dialog
        v-model="dialog"
        width="500"
      >
        <template #activator="{on,attrs}">
          <v-btn
            x-small
            fab
            color="primary"
            v-bind="attrs"
            v-on="on"
          >
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </template>

        <v-card>
          <v-card-title class="primary white--text">
            {{ formTitle }} Treatment
          </v-card-title>
          <ValidationObserver
            v-slot="{invalid}"
            ref="treatmentPlanObserver"
          >
            <v-card-text>
              <ValidationProvider
                v-slot="{ errors }"
                rules="required"
              >
                <v-textarea
                  v-model.trim="form.treatment"
                  class="mt-5"
                  rows="3"
                  dense
                  label="Treatment"
                  clearable
                  :error-messages="form.errors.treatment || errors"
                  :error="form.errors.treatment"
                  required
                />
              </ValidationProvider>
              <ValidationProvider
                v-slot="{ errors }"
                rules="required|min_value:1|max_value:500000"
              >
                <v-text-field
                  v-model="form.total_fee"
                  label="Total Fee"
                  clearable
                  type="number"
                  prefix="₱"
                  :error-messages="form.errors.total_fee || errors"
                  :error="form.errors.total_fee"
                  required
                />
              </ValidationProvider>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn
                color="grey"
                text
                @click="close"
              >
                Close
              </v-btn>
              <v-btn
                :disabled="invalid"
                color="primary"
                text
                @click.native="updateOrCreateTreatmentPlan"
              >
                Save
              </v-btn>
            </v-card-actions>
          </ValidationObserver>
        </v-card>
      </v-dialog>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="treatmentPlans"
      :items-per-page="10"
    >
      <template #item.status.name="{item}">
        <v-chip
          small
          :color="item.status.id === 1 ? 'success' : 'warning'"
        >
          {{ item.status.name }}
        </v-chip>
      </template>
      <template #item.actions="{ item }">
        <div class="d-flex">
          <!--          <v-icon
                      small
                      class="mr-2"
                      @click="showUpdateForm(item)"
                    >
                      mdi-pencil
                    </v-icon>-->
          <Link
            as="v-icon"
            class="mr-2"
            small
            :href="route('patients.treatments.transactions.index',[patientId,item.id])"
          >
            mdi-eye
          </Link>
          <v-icon
            small
            color="error"
            @click="deleteTreatment(item)"
          >
            mdi-delete
          </v-icon>
        </div>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import {extend, ValidationObserver, ValidationProvider} from "vee-validate";
import {required, min_value,max_value} from "vee-validate/dist/rules";
import ConfirmDlg from "@/Components/ConfirmDlg";

extend('required', {
    ...required,
    message: 'This field is required'
});

extend('min_value', {
    ...min_value,
    message: 'Invalid input'
});

extend('max_value', {
    ...max_value,
    message: 'Invalid input'
});

const formData = {
    treatment: '',
    total_fee: null,
};

export default {
    name: "TreatmentPlans",
    components: {
        Link,
        ConfirmDlg,
        ValidationProvider,
        ValidationObserver
    },
    data(){
        return {
            dialog: false,
            form: this.$inertia.form(formData),
            headers: [
                {
                    text: 'Date',
                    align: 'start',
                    value: 'created_at'
                },
                { text: 'Treatment Plan', value: 'treatment', width: '60%'},
                { text: 'Total Fee', value: 'total_fee' },
                { text: 'Balance', value: 'balance' },
                { text: 'Status', value: 'status.name' },
                { text: 'Actions', value: 'actions',sortable: false },
            ]
        }
    },
    computed:{
        treatmentPlans() {
            return this.$page.props.patient.treatment_plans
        },
        patientId(){
            return this.$page.props.patient.id
        },
        formTitle() {
            return this.form.id ? 'Edit' : 'Add'
        }
    },
    watch: {
        dialog (val) {
            val || this.close()
        }
    },
    methods: {
        updateOrCreateTreatmentPlan() {
            if(Object.hasOwn(this.form,'id')) this.form.patch(this.route('patients.treatments.update',[this.patientId,this.form.id]),{
                onSuccess: this.close()

            })
            else this.form.post(this.route('patients.treatments.store',this.patientId),{
                onSuccess: this.close()
            });

        },
        showUpdateForm(item){
            this.form = this.$inertia.form(item)
            this.dialog = true;
        },
        close(){
            this.dialog = false
            this.$nextTick(() => {
                this.form.clearErrors()
                this.form = this.$inertia.form(formData)
                this.$refs.treatmentPlanObserver.reset()
            })
        },
        async deleteTreatment({id}){
            await this.$refs.confirm.open(
                "Confirm",
                "Are you sure you want to delete this record?",
                {
                    "color":"error"
                }
            ) && this.form.delete(this.route('patients.treatments.destroy',[this.patientId,id]))
        }
    }
}
</script>
