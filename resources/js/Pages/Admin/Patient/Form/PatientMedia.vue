<template>
  <v-card>
    <confirm-dlg ref="confirm" />
    <universal-toast ref="toast" />
    <v-card-title>
      Files
      <v-spacer />
      <v-dialog
        v-model="dialog"
        width="500px"
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
        <ValidationObserver
          v-slot="{ invalid }"
          ref="fileObserver"
        >
          <v-card>
            <v-card-title>
              File Upload
              <v-spacer />
              <v-btn
                icon
                @click="dialog = false"
              >
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
            <v-card-text>
              <validation-provider
                v-slot="{ errors }"
                rules="required|image"
              >
                <v-file-input
                  v-model="form.patientFile"
                  background-color="primary lighten-2"
                  rounded
                  show-size
                  small-chips
                  accept="image/*"
                  placeholder="Choose file..."
                  :error-messages="form.errors.patientFile || errors"
                  :error="form.errors.patientFile"
                  hint="* Image files only"
                  persistent-hint
                />
              </validation-provider>
            </v-card-text>
            <v-card-actions>
              <v-btn
                color="primary"
                block
                large
                :loading="form.processing"
                :disabled="invalid"
                @click="uploadFile"
              >
                Upload
              </v-btn>
            </v-card-actions>
          </v-card>
        </ValidationObserver>
      </v-dialog>
    </v-card-title>
    <v-simple-table dense>
      <template #default>
        <thead>
          <tr>
            <th class="text-left">
              File
            </th>
            <th class="text-center">
              Actions
            </th>
          </tr>
        </thead>
        <template v-if="medias.length === 0">
          <tbody>
            <tr>
              <td class="text--secondary">
                No files uploaded
              </td>
            </tr>
          </tbody>
        </template>
        <tbody>
          <tr
            v-for="item in medias"
            :key="item.id"
          >
            <td>{{ item.custom_properties.original_file_name }}</td>
            <td class="text-center">
              <v-icon
                small
                class="mr-2 text-decoration-none"
                :href="route('patients.medias.show',[patientId,item.id])"
                tag="a"
                target="_blank"
              >
                mdi-eye
              </v-icon>
              <v-icon
                color="error"
                small
                @click.prevent="deleteFile(item)"
              >
                mdi-delete
              </v-icon>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-card>
</template>

<script>
import {extend, ValidationObserver, ValidationProvider} from "vee-validate";
import {required, image} from "vee-validate/dist/rules";
import ConfirmDlg from "@/Components/ConfirmDlg";
import UniversalToast from "@/Components/UniversalToast";

extend('required', {
    ...required,
    message: 'No file uploaded.'
});

extend('image', {
    ...image,
    message: 'File is not an image.'
});
export default {
    name: "PatientMedia",
    components:{
        UniversalToast,
        ConfirmDlg,
        ValidationProvider,
        ValidationObserver
    },
    data(){
        return {
            dialog: false,
            form: this.$inertia.form({
                patientFile: null,
            }),
        }
    },
    computed:{
        medias(){
            return this.$page.props.patient.media
        },
        patientId(){
            return this.$page.props.patient.id
        }
    },
    watch: {
        dialog(val){
            val || this.closeDialog()
        }
    },
    methods: {
        uploadFile(){
            this.form.post(this.route('patients.medias.store',this.patientId),{
                onSuccess: () => {
                    this.form.reset()
                    this.dialog = false
                    this.$refs.fileObserver.reset()
                    this.$refs.toast.show({message: 'File Uploaded Successfully!'})
                },
            })
        },
        deleteFile: async function ({id}) {
            await this.$refs.confirm.open(
                "Confirm",
                "Are you sure you want to delete this file?",
                {
                    "color":"error"
                }
            ) && this.form.delete(this.route('patients.medias.destroy', [this.patientId, id]))
        },
        closeDialog(){
            this.form.reset()
            this.$refs.fileObserver.reset()
        }
    }
}
</script>

<style scoped>

</style>
