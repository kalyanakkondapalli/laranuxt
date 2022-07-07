<template>
  <section class="flex flex-col">
    <header class="flex justify-between">
      <h2 class="text-2xl text-gray-500 font-semibold">What do you bring to our company</h2>
      <div class="text-right">
        <EditButton @edit="showEditForm" />
      </div>
    </header>

    <p v-if="!showEdit" class="flex-1 py-8">
      <span v-if="aboutMe === ''">Write what are you brining to our company if we hire you</span>
      {{ aboutMe }}
    </p>
    <el-form v-if="showEdit" class="flex-1">
      <el-form-item label="Write the value you bring to our organisation">
        <el-input v-model="form.nature" type="textarea" rows="15" class="w-full" />
        <FormError error-key="nature" />
      </el-form-item>
      <div class="text-right">
        <el-button type="primary" :loading="busy" @click.prevent="onFormSubmit">Update</el-button>
      </div>
    </el-form>
  </section>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { errorNotification, successNotification } from '@/helpers/notifications'

export default {
  name: 'SummaryComponent',

  data () {
    return {
      busy: false,
      showEdit: false,
      form: {
        nature: '',
      },
    }
  },

  computed: {
    aboutMe () {
      if (this.profile)
        return this.profile.nature

      return ''
    },
    ...mapGetters('profile', ['profile']),
    ...mapGetters('errors', ['error']),
    ...mapGetters('messages', ['message']),
  },

  methods: {
    async onFormSubmit () {
      this.busy = true
      await this.update({
        id: this.profile.id,
        nature: this.form.nature,
      })
      this.busy = false

      if (this.message) {
        successNotification(this.message)
        this.showEditForm()
      }

      if (this.error)
        errorNotification(this.message)
    },

    showEditForm () {
      this.showEdit = !this.showEdit
      this.form.nature = this.profile.nature
    },

    ...mapActions({
      update: 'nature/update',
    }),
  },
}
</script>

<style scoped>

</style>
