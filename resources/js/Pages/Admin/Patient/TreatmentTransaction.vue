<template>
  <div>
    <confirm-dlg ref="confirmCreate"/>
    <div class="mb-2">
      <Link
        :href="route('patients.show',[patient.id])"
        as="v-btn"
        text
        outlined
      >
        Back
      </Link>
    </div>
    <v-card
      color="transparent"
      flat
    >
<!--        Treatment Information-->
        <v-row>
            <v-col md="6">
                <v-card flat>
                    <v-card-title class="primary white--text mb-5">
                        Treatment Information
                    </v-card-title>
                    <v-card-text>
                        <v-text-field
                            readonly
                            :value="patient.full_name"
                            label="Patient :"
                            filled
                            shaped
                        />
                        <v-text-field
                            readonly
                            :value="treatment.created_at"
                            label="Treatment Date:"
                            filled
                            shaped
                        />
                        <v-text-field
                            readonly
                            :value="treatment.treatment"
                            label="Treatment :"
                            filled
                            shaped
                        />
                        <v-row>
                            <v-col>
                                <v-text-field
                                    readonly
                                    :value="treatment.total_fee"
                                    label="Total Fee :"
                                    filled
                                    shaped
                                />
                            </v-col>
                            <v-col>
                                <v-text-field
                                    readonly
                                    :value="treatment.balance"
                                    label="Balance :"
                                    filled
                                    shaped
                                />
                            </v-col>
                        </v-row>
                        <v-text-field
                            readonly
                            :value="treatment.status_id === 1 ? 'Paid' : 'Unpaid'"
                            label="Status :"
                            filled
                            shaped
                            :background-color="paid ? 'success' : 'warning'"
                            dark
                            hide-details
                        />
                    </v-card-text>
                    <v-card-actions class="justify-end pa-5" v-if="!paid">
                        <v-btn color="success" @click="markPaid" :disabled="hasBalance">Mark as paid</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

<!--        Transactions-->
      <v-card
        flat
        class="mt-5"
      >
        <v-card-title class="primary white--text">
          Transactions
        </v-card-title>
        <v-card flat>
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
                  v-if="!paid"
                  :disabled="!hasBalance"
                >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-card-title class="primary white--text">
                  {{ formTitle }} Treatment Plan
                </v-card-title>
                <ValidationObserver
                  v-slot="{invalid}"
                  ref="transactionObserver"
                >
                  <v-card-text>
                    <ValidationProvider
                      v-slot="{ errors }"
                      rules="required"
                    >
                      <v-textarea
                        v-model.trim="form.treatment_process"
                        class="mt-5"
                        rows="3"
                        dense
                        label="Treatment Plan"
                        clearable
                        :error-messages="form.errors.treatment_process || errors"
                        :error="form.errors.treatment_process"
                        required
                      />
                    </ValidationProvider>
                    <ValidationProvider
                      v-slot="{ errors }"
                      rules="required|min_value:0.1|max_value:500000"
                    >
                      <v-text-field
                        v-model="form.fee"
                        label="Fee"
                        clearable
                        type="number"
                        prefix="₱"
                        :error-messages="form.errors.fee || errors"
                        :error="!!form.errors.fee"
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
                      @click.native="createTreatmentPlan"
                      :loading="form.processing"
                    >
                      Save
                    </v-btn>
                  </v-card-actions>
                </ValidationObserver>
              </v-card>
            </v-dialog>
          </v-card-title>
          <v-simple-table>
            <template #default>
              <thead>
                <tr>
                  <th class="text-left">
                    Transaction Date
                  </th>
                  <th class="text-left" style="width: 100%">
                    Plan
                  </th>
                  <th class="text-left">
                    Payment
                  </th>
                  <th class="text-center">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-if="treatment.transactions.length !== 0"
                  v-for="transaction in treatment.transactions"
                  :key="transaction.id"
                >
                  <td class="fitwidth">{{ transaction.transaction_date }}</td>
                  <td class="fitwidth">{{ transaction.treatment_process }}</td>
                  <td class="py-2"><span v-html="transaction.details"></span></td>
                  <td class="fitwidth">{{ transaction.fee }}</td>
                  <td class="text-center fitwidth">
                      <v-icon
                        small
                        color="success"
                        @click="showForm(transaction)"
                      >
                        mdi-pencil
                      </v-icon>
<!--                      <v-icon-->
<!--                        small-->
<!--                        color="error"-->
<!--                      >-->
<!--                        mdi-delete-->
<!--                      </v-icon>-->
                  </td>
                </tr>
                <tr v-else>
                  <td
                    colspan="4"
                    class="text-center grey--text"
                  >
                    No transactions found
                  </td>
                </tr>
                <tr>
                  <th colspan="2">
                    Balance
                  </th>
                  <td
                    class="text-right"
                  >
                    <strong>{{ treatment.balance }}</strong>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card>
      </v-card>
    </v-card>
  </div>
</template>

<script>
import {extend, ValidationObserver, ValidationProvider} from "vee-validate";
import AppLayout from "@/Layouts/AppLayout";
import {Link} from "@inertiajs/inertia-vue";
import {max_value, min_value, required} from "vee-validate/dist/rules";
import ConfirmDlg from "@/Components/ConfirmDlg";
import { TiptapVuetify, BulletList, ListItem } from 'tiptap-vuetify'
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

export default {
    name: "TreatmentTransaction",
    components: {
        ConfirmDlg,
        ValidationObserver,
        ValidationProvider,
        Link,
        TiptapVuetify
    },
    layout: AppLayout,
    props: {
        treatment: {
            type: Object,
            required: true
        },
        patient: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            extensions: [
                ListItem,
                BulletList
            ],
            dialog: false,
            form: this.$inertia.form(formData),
        }
    },
    computed: {
        formTitle(){
            return this.isUpdateTransaction ? 'Edit' : 'Add'
        },
        paid(){
            return this.treatment.status_id === 1
        },
        hasBalance(){
            return this.treatment.balance*1 > 0
        },
        isUpdateTransaction(){
            return Object.hasOwn(this.form,'id')
        }

    },
    watch: {
        'form.fee' (){
            this.form.clearErrors()
        }
    },
    methods: {
        async saveTreatmentPlan(){
            const confirm = await this.$refs.confirmCreate.open('Save','<p class="ma-0">Are you sure you want to continue?</p>',{color:'error'})
            if(!confirm) return;

            if(this.isUpdateTransaction){
                this.form.patch(this.route('patients.treatments.transactions.update',[this.patient.id,this.treatment.id,this.form.id]),{
                    preserveScroll: true,
                    onSuccess: () => this.close()
                });
            }else{
                this.form.post(this.route('patients.treatments.transactions.store',[this.patient.id,this.treatment.id]),{
                    preserveScroll: true,
                    onSuccess: () => this.close()
                });
            }
        },
        close(){
            this.dialog = false
            this.$nextTick(() => {
                this.form.clearErrors()
                this.form.reset()
                this.$refs.transactionObserver.reset()
            })
        },
        async markPaid(){
            const confirm = await this.$refs.confirmCreate.open('Mark As Paid','<p class="ma-0">Are you sure you want to continue?</p> This cannot be undone, and you can\'t add additional transactions.',{color:'error'})

            confirm && this.$inertia.patch(this.route('patients.treatments.update',[this.patient.id,this.treatment.id]),{status_id:1})
        },
        showForm(transaction = null){
            if(transaction)
            this.form = this.$inertia.form(transaction)

            this.dialog = true;
        }
    }
}
</script>

<style scoped>
    td.fitwidth {
        width: 1px;
        white-space: nowrap;
    }

    tbody >>> p {
        margin-bottom: 0;
    }
</style>
