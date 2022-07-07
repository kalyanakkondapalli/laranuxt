<template>
  <section class="flex flex-col">
    <header class="flex justify-between">
      <h2 class="text-2xl text-gray-500 font-semibold">About Yourself</h2>
      <div class="text-right">
        <EditButton @edit="showEditForm" />
      </div>
    </header>

    <p v-if="!showEdit" class="flex-1 py-8">
      <span v-if="aboutMe === ''">Add about your self</span>
      {{ aboutMe }}
    </p>
    <el-form v-if="showEdit" class="flex-1">
      <el-form-item label="Tell about yourself">
        <el-input v-model="form.about_me" type="textarea" rows="15" class="w-full" />
        <FormError error-key="about_me" />
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
  name: 'AboutMeComponent',

  data () {
    return {
      busy: false,
      showEdit: false,
      form: {
        about_me: '',
      },
    }
  },

  computed: {
    aboutMe () {
      if (this.profile)
        return this.profile.about_me

      return ''
    },
    ...mapGetters('profile', ['profile']),
    ...mapGetters('errors', ['error']),
    ...mapGetters('messages', ['message']),
  },

  created () {
    this.form.about_me = this.profile?.about_me
  },

  methods: {
    async onFormSubmit () {
      this.busy = true
      await this.updateAbout({
        id: this.profile.id,
        about_me: this.form.about_me,
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
    },

    ...mapActions({
      updateAbout: 'about/update',
    }),
  },
}
</script>

<style scoped>

</style>
