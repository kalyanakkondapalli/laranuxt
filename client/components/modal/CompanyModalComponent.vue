<template>
  <el-dialog
    title="Company Details"
    :visible.sync="showDialog"
    width="30%"
    :close-on-press-escape="false"
    destroy-on-close
    :before-close="onClose"
  >
    <section>
      <el-form label-width="150">
        <el-form-item label="Company Name">
          <el-input v-model="form.company_name" />
          <FormError error-key="company_name" />
        </el-form-item>
        <el-form-item label="Current Role">
          <el-input v-model="form.role" />
          <FormError error-key="role" />
        </el-form-item>
        <el-form-item label="Work Nature">
          <el-input v-model="form.job_nature" type="textarea" />
          <FormError error-key="job_nature" />
        </el-form-item>
        <el-form-item label="Start Date">
          <el-date-picker
            v-model="form.start_date"
            type="date"
            placeholder="Start Date"
            :picker-options="startPickerOptions"
          />
          <FormError error-key="email" />
        </el-form-item>
        <el-form-item label="End Date">
          <el-date-picker
            v-model="form.end_date"
            :disabled="form.is_current_working"
            type="date"
            placeholder="End Date"
            :picker-options="endPickerOptions"
          />
          <FormError error-key="contact" />
        </el-form-item>
        <el-checkbox v-model="form.is_current_working">Currently working here</el-checkbox>
        <div class="text-right">
          <el-button type="primary" :loading="busy" @click="onFormSubmit">Update</el-button>
        </div>
      </el-form>
    </section>
  </el-dialog>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import moment from 'moment'
import { errorNotification, successNotification } from '@/helpers/notifications'
export default {
  name: 'CompanyModalComponent',

  props: {
    showDialog: {
      type: Boolean,
      required: true,
    },
    company: {
      type: [Object, null],
      required: true,
    },
  },

  data () {
    return {
      busy: false,
      startPickerOptions: {
        disabledDate (time) {
          return time.getTime() > Date.now()
        },
      },
      endPickerOptions: {
        disabledDate (time) {
          return time.getTime() < Date.now()
        },
      },
      form: {
        company_name: '',
        start_date: '',
        end_date: '',
        role: '',
        is_current_working: false,
        job_nature: '',
      },
    }
  },

  computed: {
    ...mapGetters('messages', ['message']),
    ...mapGetters('errors', ['error']),
  },
  mounted () {
    this.form = { ...{}, ...this.company }
  },

  methods: {
    onClose () {
      this.$emit('close')
    },
    async onFormSubmit () {
      this.busy = true
      this.form.start_date = moment(this.form.start_date).format('YYYY-MM-DD')
      this.form.end_date = moment(this.form.end_date).format('YYYY-MM-DD')
      await this.update({
        data: this.form,
        id: this.company.id,
      })
      this.busy = false

      if (this.message)
        successNotification(this.message)

      if (this.error)
        errorNotification(this.error)
    },

    ...mapActions({
      update: 'company/update',
    }),
  },
}
</script>

<style scoped>

</style>
