<template>
  <el-dialog
    title="Update Profile Details"
    :visible.sync="showDialog"
    width="30%"
    :close-on-press-escape="false"
    destroy-on-close
    :before-close="onClose"
  >
    <section>
      <el-form label-width="150">
        <el-form-item label="Full Name">
          <el-input v-model="form.name" />
          <FormError error-key="name" />
        </el-form-item>
        <el-form-item label="Email Address">
          <el-input v-model="form.email" type="email" />
          <FormError error-key="email" />
        </el-form-item>
        <el-form-item label="Contact Number">
          <el-input v-model="form.contact" type="tel" />
          <FormError error-key="contact" />
        </el-form-item>
        <el-form-item label="Designation">
          <el-input v-model="form.qualification" />
          <FormError error-key="qualification" />
        </el-form-item>
        <el-form-item label="Years of Experience (in years)">
          <el-input v-model="form.years_of_experience" />
          <FormError error-key="years_of_experience" />
        </el-form-item>
        <div class="text-right">
          <el-button type="primary" :loading="busy" @click="onFormSubmit">Update</el-button>
        </div>
      </el-form>
    </section>
  </el-dialog>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import { errorNotification, successNotification } from '@/helpers/notifications'
export default {
  name: 'ProfileModalComponent',

  props: {
    showDialog: {
      type: Boolean,
      required: true,
    },
    profile: {
      type: Object,
      required: true,
    },
  },

  data () {
    return {
      busy: false,
      form: {
        name: '',
        email: '',
        qualification: '',
        years_of_experience: '',
        contact: '',
      },
    }
  },

  computed: {
    ...mapGetters('messages', ['message']),
    ...mapGetters('errors', ['error']),
  },
  mounted () {
    this.form = { ...{}, ...this.profile }
  },

  methods: {
    onClose () {
      this.$emit('close')
    },
    async onFormSubmit () {
      this.busy = true
      await this.updateProfile({
        data: this.form,
        id: this.profile.id,
      })
      this.busy = false

      if (this.message)
        successNotification(this.message)

      if (this.error)
        errorNotification(this.error)
    },

    ...mapActions({
      updateProfile: 'profile/update',
    }),
  },
}
</script>

<style scoped>

</style>
