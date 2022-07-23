<template>
  <div>
    <div class="text-right mb-5">
      <Link
        as="v-btn"
        type="button"
        tile
        color="primary"
        :href="route('patients.create')"
      >
        <v-icon left>
          mdi-plus
        </v-icon>
        Add Patient
      </Link>
    </div>

    <v-card>
      <v-card-title>
        Patients
        <v-spacer />
        <v-text-field
          v-model.trim="search"
          append-icon="mdi-magnify"
          label="Search Patient's Name"
          single-line
          hide-details
        />
      </v-card-title>

      <v-data-table
        :headers="headers"
        :items="patients.data"
        :search="search"
        class="elevation-1"
      >
        <template #item.id="{ item }">
          <Link
              as="v-btn"
            icon
              :href="route('patients.show',item.id)"
          >
            <v-icon
              small
            >
              mdi-eye
            </v-icon>
          </Link>
          <Link
            as="v-btn"
            icon
            :href="route('patients.edit',item.id)"
          >
            <v-icon
              small
            >
              mdi-pencil
            </v-icon>
          </Link>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from '@inertiajs/inertia-vue'

export default {
    name: "PatientIndex",
    components: {
        AppLayout,
        Link
    },
    layout: AppLayout,
    props: {
        patients: {
            required: true,
            type: Object
        }
    },
    data(){
        return {
            search: '',
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'full_name',
                },
                { text: 'Telephone', value: 'telephone' },
                { text: 'Mobile No.', value: 'mobile_no' },
                { text: 'Birth Date', value: 'birth_date' },
                { text: 'Action', value: 'id', align: 'center' },
            ]
        }
    }
}
</script>

<style scoped>

</style>
