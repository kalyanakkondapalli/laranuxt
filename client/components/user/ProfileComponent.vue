<template>
  <section class="py-8 flex gap-4 justify-between items-center">
    <ProfileImageComponent />
    <section v-if="profile" class="relative">
      <article class="flex flex-col profile details flex-1 mt-4">
        <div class="flex text-xl text-gray-500 justify-between">
          Name: <span
            class="font-semibold text-left"
          >{{ profile.name }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Email: <span class="font-semibold text-left">{{ profile.email }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Contact: <span class="font-semibold text-left">{{ profile.contact }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Qualification: <span class="font-semibold text-left">{{ profile.qualification }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Years of Experience: <span
            class="font-semibold text-left"
          >{{ profile.years_of_experience }} years</span>
        </div>
      </article>
      <EditButton class="text-center block mx-auto" @edit="onEditProfile" />
    </section>
    <ProfileModalComponent v-if="profile" :profile="profile" :show-dialog="showProfileDialog" @close="closeEditProfile" />
  </section>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ProfileComponent',

  data () {
    return {
      loading: false,
      showProfileDialog: false,
    }
  },

  computed: {
    ...mapGetters('profile', ['profile']),
  },

  methods: {
    closeEditProfile () {
      this.showProfileDialog = false
    },
    onEditProfile () {
      this.showProfileDialog = true
    },
  },
}
</script>

<style scoped>

</style>
