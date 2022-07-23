<template>
  <v-stepper :value="step">
    <v-stepper-header>
      <v-stepper-step
        :complete="step > 1"
        step="1"
      >
        Biodata
      </v-stepper-step>

      <v-divider />

      <v-stepper-step
        :complete="step > 2"
        step="2"
      >
        Medical History
      </v-stepper-step>

      <v-divider />

      <v-stepper-step step="3">
        Dental History
      </v-stepper-step>
    </v-stepper-header>
      <v-stepper-items>
          <slot/>
      </v-stepper-items>
  </v-stepper>
</template>

<script>
export default {
    name: "CustomStepper",
    props: {
        step: {
            required: true
        }
    }
}
</script>

