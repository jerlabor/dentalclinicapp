<template>
    <v-dialog
        v-bind:value="value"
        persistent
        max-width="30%"
    >
        <v-card>
            <v-card-title class="text-sm red white--text">
                {{ title }}
            </v-card-title>
            <v-card-text class="pa-5 text-subtitle-1">
                <slot name="text"></slot>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="grey grey-1"
                    text
                    @click="$emit('disagree', $event.target.value)"
                >
                    Cancel
                </v-btn>
                <v-btn
                    color="red red-1"
                    text
                    @click="$emit('confirm')"
                >
                    Confirm
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "ConfirmationDialog",
    props: {
        show: {
            type: Boolean
        },
        title: {
            type: String,
            required: true
        },
        value: {
            type: Boolean
        }
    }
}
</script>

<style scoped>

</style>
