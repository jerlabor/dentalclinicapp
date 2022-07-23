<template>
  <ValidationObserver v-slot="{ invalid,validate }">
    <v-card>
      <v-card-text>
        <v-form :readonly="readonly">
          <v-row>
            <v-col
              cols="12"
              md="3"
            >
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.first_name"
                  label="First Name *"
                  :error-messages="form.errors.first_name || errors"
                  :error="form.errors.first_name"
                  required
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
                  v-model.trim="form.middle_name"
                  label="Middle Name *"
                  :error-messages="form.errors.middle_name || errors"
                  :error="form.errors.middle_name"
                  required
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
                  v-model.trim="form.last_name"
                  label="Last Name *"
                  :error-messages="form.errors.last_name || errors"
                  :error="form.errors.last_name"
                  required
                />
              </validation-provider>
            </v-col>
            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model.trim="form.suffix"
                label="Suffix"
              />
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
                  v-model.trim="form.birth_date"
                  label="Birth Date *"
                  type="date"
                  :error-messages="form.errors.birth_date || errors"
                  :error="form.errors.birth_date"
                  required
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
                <v-select
                  v-model="form.gender"
                  :items="[{gender: 'Male' ,id:1},{gender: 'Female' ,id:0}]"
                  label="Sex *"
                  item-text="gender"
                  item-value="id"
                  :error-messages="form.errors.gender || errors"
                  :error="form.errors.gender"
                  required
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
                <v-select
                  v-model="form.marital_status_id"
                  :items="maritalStatuses"
                  label="Civil Status *"
                  item-text="marital_status"
                  item-value="id"
                  :error-messages="form.errors.marital_status_id || errors"
                  :error="form.errors.marital_status_id"
                  required
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
                  v-model.trim="form.occupation"
                  label="Occupation *"
                  type="text"
                  :error-messages="form.errors.occupation || errors"
                  :error="form.errors.occupation"
                />
              </validation-provider>
            </v-col>
            <v-col
              v-if="form.marital_status_id === 2"
              cols="12"
            >
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.spouse"
                  label="Spouse *"
                  type="text"
                  :error-messages="form.errors.spouse || errors"
                  :error="form.errors.spouse"
                />
              </validation-provider>
            </v-col>
            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model.trim="form.telephone"
                label="Telephone"
                type="text"
              />
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
                  v-model.trim="form.mobile_no"
                  label="Mobile No. *"
                  type="text"
                  :error-messages="form.errors.mobile_no || errors"
                  :error="form.errors.mobile_no"
                  required
                />
              </validation-provider>
            </v-col>
            <v-col cols="12">
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.address"
                  label="Address *"
                  :error-messages="form.errors.address || errors"
                  :error="form.errors.address"
                  required
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
                  v-model.number="form.height"
                  label="Height (cm) *"
                  type="number"
                  :error-messages="form.errors.height || errors"
                  :error="form.errors.height"
                  required
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
                  v-model.number="form.weight"
                  label="Weight (kg) *"
                  type="number"
                  :error-messages="form.errors.weight || errors"
                  :error="form.errors.weight"
                  required
                />
              </validation-provider>
            </v-col>
            <v-col cols="12">
              <validation-provider
                v-slot="{ errors }"
                rules="required"
              >
                <v-text-field
                  v-model.trim="form.remarks"
                  label="Remarks *"
                  :error-messages="form.errors.remarks || errors"
                  :error="form.errors.remarks"
                  required
                />
              </validation-provider>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
      <v-card-actions v-if="!readonly">
        <Link
          :href="route('patients.index')"
          as="v-btn"
          text
          type="button"
        >
          Back
        </Link>
        <v-btn
          color="primary"
          :disabled="invalid"
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
import { required } from 'vee-validate/dist/rules';
import {Link} from "@inertiajs/inertia-vue";

extend('required', {
    ...required,
    message: 'This field is required'
});

export default {
    name: "BioData",
    components:{
        Link,
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
            })
        }
    },
    computed: {
        maritalStatuses(){
            return this.$page.props.maritalStatuses
        }
    },
    created() {
        if(this.$page.props.patient) this.form.defaults(this.$page.props.patient)
        this.form.reset()
    }
}
</script>
