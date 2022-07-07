<template>
  <el-row v-loading.fullscreen.lock="loading" class="space-y-4">
    <ProfileComponent />
    <hr />
    <AboutMeComponent />
    <hr />
    <CompanyComponent />
    <hr />
    <SkillsComponent />
    <hr />
    <SummaryComponent />
  </el-row>
</template>

<script>
export default {
  name: 'Index',
  data () {
    return {
      loading: true,
    }
  },
  async created () {
    this.loading = true
    await this.$store.dispatch('profile/show')
    this.loading = false
  },
}
</script>

<style>
.el-loading-spinner {
  display: flex;
  justify-content: center;
}
</style>
