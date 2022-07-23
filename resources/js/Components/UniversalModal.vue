<template>
    <v-dialog
        :value="show"
        persistent
        max-width="500px"
    >
        <v-card>
            <v-card-title class="primary white--text">
                {{ title }}
            </v-card-title>
            <v-card-text>
                <slot></slot>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="grey"
                    text
                    @click="$emit('close')"

                >
                    Close
                </v-btn>
                <v-btn
                    color="blue"
                    text
                    @click="$emit('save')"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: 'UniversalModal',
        props:{
            show: {
                type: Boolean
            },
            title: {
                type: String,
                required: true
            }
        }
    }
</script>
