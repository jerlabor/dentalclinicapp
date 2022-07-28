<template>
  <ValidationObserver v-slot="{ invalid,validate }">
    <v-card>
      <v-card-text>
        <v-form :readonly="readonly">
          <v-row>
            <v-col cols="12">
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.dental_problem"
                  label="1.What is your immediate dental problem?"
                  :error-messages="form.errors.dental_problem || errors"
                  :error="form.errors.dental_problem"
                />
              </validation-provider>
            </v-col>
            <v-col
              cols="12"
              md="3"
            >
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model="form.last_dental_visit"
                  type="date"
                  label="Date of Last Dental Visit"
                  :max="new Date().toLocaleDateString('en-CA')"
                  :error-messages="form.errors.last_dental_visit || errors"
                  :error="form.errors.last_dental_visit"
                />
              </validation-provider>
            </v-col>
            <v-col
              cols="12"
              md="3"
            >
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.previous_dentist"
                  label="Previous Dentist"
                  :error-messages="form.errors.previous_dentist || errors"
                  :error="form.errors.previous_dentist"
                />
              </validation-provider>
            </v-col>
            <v-col cols="12">
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.address_previous_dentist"
                  label="Address of Previous Dentist"
                  :error-messages="form.errors.address_previous_dentist || errors"
                  :error="form.errors.address_previous_dentist"
                />
              </validation-provider>
            </v-col>
          </v-row>
          <v-card flat>
            <v-card-title class="text-subtitle-2 pl-0">
              Please check if you have or have had any of the following:
            </v-card-title>
            <v-row
              dense
              no-gutters
            >
              <v-col
                v-for="illness in dentalIllnesses"
                :key="illness.id"
                cols="12"
                md="3"
              >
                <v-checkbox
                  v-model="form.illnesses"
                  multiple
                  :label="illness.illness_name"
                  :value="illness.id"
                />
              </v-col>
            </v-row>
            <!--            <v-simple-table
              v-if="form.patient_illnesses.length > 0"
              dense
            >
              <template #default>
                <thead>
                  <tr>
                    <th
                      class="text-left"
                      style="width: 20%"
                    >
                      Illness
                    </th>
                    <th class="text-left">
                      Details
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="illness in form.patient_illnesses"
                    :key="illness.id"
                  >
                    <td>{{ illness.illness_name }}</td>
                    <td>
                      <v-text-field
                        v-model.trim="illness.illness_details"
                        label="Enter Details"
                      />
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>-->
          </v-card>
        </v-form>
      </v-card-text>
      <v-card-actions v-if="!readonly">
        <v-btn
          text
          @click="$emit('cancel')"
        >
          Back
        </v-btn>
        <v-btn
          :disabled="invalid || form.processing"
          color="primary"
          :loading="form.processing"
          @click="$emit('submit',{form,validate})"
        >
          Save
        </v-btn>
      </v-card-actions>
    </v-card>
  </ValidationObserver>
</template>

<script>
import { ValidationObserver, ValidationProvider, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';


extend('required', {
    ...required,
    message: 'This field is required'
});

export default {
    name: "DentalHistory",
    components:{
        ValidationProvider,
        ValidationObserver
    },
    props: {
        readonly: {
            type: Boolean
        }
    },
    data(){
        return {
            form: this.$inertia.form({
                dental_problem: '',
                last_dental_visit: null,
                previous_dentist: '',
                address_previous_dentist: '',
                illnesses: []
            })
        }
    },
    computed:{
        dentalIllnesses() {
            return this.$page.props.dentalIllnesses
        }
    },
    created() {
        if(this.$page.props.patient?.dental_history) this.form.defaults({...this.$page.props.patient.dental_history,illnesses:this.$page.props.patient.illnesses.map(illness => illness.id)})

        this.form.reset()
    }
}
</script>

