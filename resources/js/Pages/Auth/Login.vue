<template>
   <v-app>
       <v-main class="grey lighten-3">
           <v-row class="tw-h-full" justify="center" align="center">
               <v-col cols="12" md="3">
                   <v-card elevation="3">
                       <v-card-title class="justify-center primary white--text">
                           Boss Floss Dental Clinic
                       </v-card-title>
                       <v-divider/>
                       <v-card-text>
                           <v-alert
                               v-if="errors.username"
                               dense
                               text
                               type="error"
                           >
                               {{ errors.username }}
                           </v-alert>
                           <validation-observer
                               v-slot="{ invalid }"
                           >
                               <v-form @submit.prevent="submit">
                                   <validation-provider
                                       v-slot="{ errors }"
                                       rules="required"
                                   >
                                       <v-text-field
                                           v-model="form.username"
                                           label="Username"
                                           prepend-icon="mdi-account"
                                           :error-messages="errors"
                                           required
                                           autofocus
                                       ></v-text-field>
                                   </validation-provider>
                                   <validation-provider
                                       v-slot="{ errors }"
                                       rules="required"
                                   >
                                       <v-text-field
                                           v-model="form.password"
                                           label="Password"
                                           prepend-icon="mdi-key"
                                           :error-messages="errors"
                                           type="password"
                                           required
                                           utocomplete="current-password"
                                       ></v-text-field>
                                   </validation-provider>
                                   <v-btn type="submit" block color="primary" class="mt-5" :disabled="form.processing || invalid">Login</v-btn>
                               </v-form>
                          </validation-observer>
                       </v-card-text>
                   </v-card>
               </v-col>
           </v-row>
       </v-main>
   </v-app>
</template>

<script>
    import { required } from 'vee-validate/dist/rules'
    import { extend, ValidationObserver, ValidationProvider } from 'vee-validate'

    extend('required', {
        ...required,
        message: 'This field is required',
    })

    export default {
        components: {
            ValidationObserver,
            ValidationProvider
        },

        props: {
            canResetPassword: Boolean,
            errors: Object
        },

        data() {
            return {
                form: this.$inertia.form({
                    username: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
