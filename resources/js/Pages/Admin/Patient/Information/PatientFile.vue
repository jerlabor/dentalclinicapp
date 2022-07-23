<template>
    <patient-information :patient-id="patient.id">
        <v-row>
            <v-col>
                <v-file-input
                    v-model="form.patientFile"
                    accept="image/*"
                    label="File input"
                ></v-file-input>
            </v-col>
            <v-col>
                <v-btn
                    large
                    @click="uploadFile"
                >Upload</v-btn>
            </v-col>
        </v-row>

        <v-simple-table>
            <template #default>
                <thead>
                <tr>
                    <th class="text-left">
                        File
                    </th>
                    <th class="text-left">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in patient.media"
                    :key="item.id"
                >
                    <td>{{ item.custom_properties.original_file_name }}</td>
                    <td><v-icon
                        small
                        class="mr-2"
                        @click="showMedia(item)"
                    >
                        mdi-eye
                    </v-icon>
                        <v-icon
                            small
                            @click.prevent="deleteFile(item)"
                        >
                            mdi-delete
                        </v-icon></td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>

    </patient-information>
</template>

<script>
import PatientInformation from "@/Layouts/Patient/PatientInformation";

export default {
    name: "PatientFile",
    props: {
        patient: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            form: this.$inertia.form({
                patientFile: null,
            }),
        }
    },
    components: {
        PatientInformation
    },
    methods: {
        uploadFile(){
            this.form.post(this.route('patients.files.store',[this.patient.id]))
        },
        deleteFile({id}){
            this.form.delete(`/files/${id}`)
        },
        downloadFile(){

        },
        showMedia({id}){
            this.form.get(this.route('patients.files.show',[this.patient.id,id]))
        }
    },
    created() {
        if(this.$page.props.patient?.medias) this.form.defaults(this.$page.props.patient.medias)
        this.form.reset()
    }

}
</script>

<style scoped>

</style>
