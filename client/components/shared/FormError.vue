<template>
  <p v-if="hasError" class="text-sm text-red-500 font-semibold">{{ message }}</p>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'FormError',
  props: {
    errorKey: {
      type: String,
      required: true,
    },
  },
  computed: {
    hasError () {
      return Object.keys(this.errors).length && this.errors[this.errorKey]
    },
    message () {
      return this.errors[this.errorKey]
    },
    ...mapGetters('errors', ['errors']),
  },
}
</script>

<style scoped>

</style>
