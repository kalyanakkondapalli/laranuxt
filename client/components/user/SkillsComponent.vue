<template>
  <section class="flex flex-col">
    <header class="flex justify-between">
      <h2 class="text-2xl text-gray-500 font-semibold">Skills</h2>
      <div class="text-right">
        <EditButton @edit="showEditForm" />
      </div>
    </header>

    <p v-if="!showEdit" class="py-8">
      <span v-for="skill in userSkills" :key="skill" class="px-4 py-2 rounded-sm bg-gray-300 text-gray-700 mr-2"> {{ skill }}</span>
    </p>
    <el-form v-if="showEdit" class="flex-1">
      <el-form-item label="Add Your Skills">
        <el-select
          v-model="form.skills"
          multiple
          class="w-full"
          filterable
          allow-create
          default-first-option
          placeholder="Add your skills"
        >
          <el-option
            v-for="item in skills"
            :key="item"
            :label="item"
            :value="item"
          />
        </el-select>
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
  name: 'SkillsComponent',
  data () {
    return {
      busy: false,
      showEdit: false,
      skills: ['VueJs', 'Reactjs', 'Laravel', 'PHP', 'Python'],
      form: {
        skills: [],
      },
    }
  },

  computed: {
    userSkills () {
      if (!this.profile)
        return []

      return this.profile.skills
    },
    ...mapGetters('profile', ['profile']),
    ...mapGetters('errors', ['error']),
    ...mapGetters('messages', ['message']),
  },
  methods: {
    async onFormSubmit () {
      this.busy = true
      await this.updateSkills({
        id: this.profile.id,
        skills: this.form.skills,
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
      updateSkills: 'skills/update',
    }),
  },
}
</script>

<style scoped>

</style>
