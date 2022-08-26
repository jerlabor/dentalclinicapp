<template>
  <div>
    <confirm-dlg ref="confirm" />
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

    <v-card
      color="primary"
      class="white--text"
    >
      <v-card-title>
        Patients
        <v-spacer />
        <v-text-field
          v-model.trim="search"
          dark
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
      >
        <template #item.id="{ item }">
            <div class="d-flex">
                <Link
                    as="v-icon"
                    :href="route('patients.show',item.id)"
                    small
                    class="mr-1"
                >
                    mdi-eye
                </Link>
                <Link
                    as="v-icon"
                    :href="route('patients.edit',item.id)"
                    small
                    class="mr-1"
                    color="success"
                >
                    mdi-pencil
                </Link>
                <v-icon
                    small
                    color="error"
                    @click="deletePatient(item)"
                >
                    mdi-delete
                </v-icon>
            </div>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from '@inertiajs/inertia-vue'
import ConfirmDlg from "@/Components/ConfirmDlg";

export default {
    name: "PatientIndex",
    components: {
        ConfirmDlg,
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
                    value: 'full_name',
                    width: '65%'
                },
                { text: 'Telephone', value: 'telephone' },
                { text: 'Mobile No.', value: 'mobile_no' },
                { text: 'Age', value: 'age' },
                { text: 'Date Added', value: 'created_at' },
                { text: 'Action', value: 'id', align: 'center' },
            ]
        }
    },
    methods: {
        deletePatient: async function (patient) {
            await this.$refs.confirm.open(
                "Confirm",
                `Are you sure you want to delete <strong>${patient.full_name}</strong>?`,
                {
                    "color":"error"
                }
            ) && this.$inertia.visit(this.route('patients.destroy',  patient.id),{method: 'delete'})
        },
    }
}
</script>

<style scoped>

</style>
