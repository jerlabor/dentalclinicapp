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
                <v-radio-group
                  v-model="form.is_care_of_physician"
                  row
                  :error-messages="form.errors.is_care_of_physician || errors"
                  :error="form.errors.is_care_of_physician"
                >
                  <template #label>
                    1. Are you under the care of a Physician?
                  </template>
                  <v-radio
                    label="Yes"
                    :value="1"
                  />
                  <v-radio
                    label="No"
                    :value="0"
                  />
                </v-radio-group>
              </validation-provider>
              <template v-if="form.is_care_of_physician">
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                >
                  <v-text-field
                    v-model.trim="form.physician.physician_name"
                    label="Name of Physician"
                    :error-messages="form.errors.physician_name || errors"
                    :error="form.errors.physician_name"
                  />
                </validation-provider>
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                >
                  <v-text-field
                    v-model.trim="form.physician.address"
                    label="Address"
                    :error-messages="form.errors.address || errors"
                    :error="form.errors.address"
                  />
                </validation-provider>
                <validation-provider
                  v-slot="{ errors }"
                  rules="required|numeric"
                >
                  <v-text-field
                    v-model.trim="form.physician.contact_no"
                    label="Contact No."
                    :error-messages="form.errors.contact_no || errors"
                    :error="form.errors.contact_no"
                  />
                </validation-provider>
                <validation-provider
                  v-slot="{ errors }"
                  rules="required|max_value:120"
                >
                  <v-text-field
                    v-model.number="form.physician.months_attended"
                    label="Mos. Attended"
                    type="number"
                    :error-messages="form.errors.months_attended || errors"
                    :error="form.errors.months_attended"
                  />
                </validation-provider>
              </template>

              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-radio-group
                  v-model="form.hospitalized"
                  row
                  :error-messages="form.errors.hospitalized || errors"
                  :error="form.errors.hospitalized"
                >
                  <template #label>
                    2. Have you been hospitalized?
                  </template>
                  <v-radio
                    label="Yes"
                    :value="1"
                  />
                  <v-radio
                    label="No"
                    :value="0"
                  />
                </v-radio-group>
              </validation-provider>

              <template v-if="form.hospitalized">
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                >
                  <v-text-field
                    v-model.trim="form.hospitalized_reason"
                    label="Reason"
                    :error-messages="form.errors.hospitalized_reason || errors"
                    :error="form.errors.hospitalized_reason"
                  />
                </validation-provider>
              </template>

              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-radio-group
                  v-model="form.is_taking_medication"
                  row
                  :error-messages="form.errors.is_taking_medication || errors"
                  :error="form.errors.is_taking_medication"
                >
                  <template #label>
                    3. Are you presently taking any medication/s?
                  </template>
                  <v-radio
                    label="Yes"
                    :value="1"
                  />
                  <v-radio
                    label="No"
                    :value="0"
                  />
                </v-radio-group>
              </validation-provider>
              <template v-if="form.is_taking_medication">
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                >
                  <v-text-field
                    v-model.trim="form.medications"
                    label="Names of medication/s"
                    :error-messages="form.errors.medications || errors"
                    :error="form.errors.medications"
                  />
                </validation-provider>
              </template>

              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-radio-group
                  v-model="form.allergic"
                  row
                  :error-messages="form.errors.allergic || errors"
                  :error="form.errors.allergic"
                >
                  <template #label>
                    4. Are you allergic to any food or drug/medication?
                  </template>
                  <v-radio
                    label="Yes"
                    :value="1"
                  />
                  <v-radio
                    label="No"
                    :value="0"
                  />
                </v-radio-group>
              </validation-provider>
              <template v-if="form.allergic">
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                >
                  <v-text-field

                    v-model.trim="form.allergy_details"
                    :error-messages="form.errors.allergy_details || errors"
                    :error="form.errors.allergy_details"
                    label="Specify"
                  />
                </validation-provider>
              </template>


              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-radio-group
                  v-model="form.smoke"
                  row
                  :error-messages="form.errors.smoke || errors"
                  :error="form.errors.smoke"
                >
                  <template #label>
                    5. Do you smoke?
                  </template>
                  <v-radio
                    label="Yes"
                    :value="1"
                  />
                  <v-radio
                    label="No"
                    :value="0"
                  />
                </v-radio-group>
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
                v-for="illness in medicalIllnesses"
                :key="illness.id"
                cols="12"
                md="3"
              >
                <v-checkbox
                  v-model="form.illnesses"
                  :label="illness.illness_name"
                  :value="illness.id"
                />
              </v-col>
            </v-row>
            <!--            <v-card-title class="text-subtitle-2 pl-0">
                         Illness Details
                       </v-card-title>
                                <v-simple-table
                         v-if="form.illnesses.length > 0"
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
                               v-for="(medicalIllness) in form.illnesses"
                               :key="medicalIllness.id"
                             >
                               <td>{{ medicalIllness.illness_name }}</td>
                               <td>
                                 <v-text-field
                                   v-model.trim="medicalIllness.pivot.illness_details"
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
          :disabled="invalid"
          color="primary"
          @click="$emit('submit',{form,validate})"
        >
          Continue
        </v-btn>
      </v-card-actions>
    </v-card>
  </ValidationObserver>
</template>

<script>
import { ValidationObserver, ValidationProvider, extend } from 'vee-validate';
import { required , max_value, numeric} from 'vee-validate/dist/rules';


extend('required', {
    ...required,
    message: 'This field is required'
});

extend('max_value', {
    ...max_value,
    message: 'Invalid input'
});

extend('numeric', {
    ...numeric,
    message: 'Input must be a number'
});

export default {
    name: "MedicalHistory",
    components:{
        ValidationProvider,
        ValidationObserver
    },
    props:{
        readonly: {
            type: Boolean
        }
    },
    data(){
        return {
            form: this.$inertia.form({
                is_care_of_physician: null,
                hospitalized: null,
                hospitalized_reason: '',
                is_taking_medication: null,
                medications: '',
                allergic: null,
                allergy_details: '',
                smoke: null,
                illnesses: [],
                physician: {
                    physician_name: '',
                    address: '',
                    months_attended: null,
                    contact_no: ''
                }
            })
        }
    },
    computed:{
        medicalIllnesses(){
            return this.$page.props.medicalIllnesses
        }
    },
    created() {
        if(this.$page.props.patient?.medical_history) {
            const formData = {...this.$page.props.patient.medical_history,illnesses:this.$page.props.patient.illnesses.filter(illness => illness.illness_group === 1).map(illness => illness.id)};

            // assign default physician fields
            if(!this.$page.props.patient.medical_history.physician) formData.physician = this.form.physician
            this.form.defaults(formData)
        }
        this.form.reset()
    }
}
</script>

