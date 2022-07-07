<template>
  <section class="py-8 flex flex-col">
    <header class="flex justify-between">
      <h2 class="text-2xl text-gray-500 font-semibold">Company Details</h2>
      <div class="text-right">
        <EditButton @edit="onEditCompany" />
      </div>
    </header>
    <section v-if="company" class="relative">
      <article class="flex flex-col profile details flex-1 max-w-screen-md mt-4">
        <div class="flex text-xl text-gray-500 justify-between">
          Company Name: <span
            class="font-semibold text-left"
          >{{ company.company_name }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Role: <span class="font-semibold text-left">{{ company.role }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Start Date: <span class="font-semibold text-left">{{ toDate(company.start_date) }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          End Date: <span class="font-semibold text-left">{{ toDate(company.end_date) }}</span>
        </div>
        <div class="flex text-xl text-gray-500 justify-between">
          Work Nature: <span
            class="font-semibold text-left"
          >{{ company.job_nature }}</span>
        </div>
      </article>
    </section>
    <CompanyModalComponent v-if="company" :company="company" :show-dialog="showCompanyDialog" @close="closeEditCompany" />
  </section>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import moment from 'moment'

export default {
  name: 'CompanyComponent',

  data () {
    return {
      loading: false,
      showCompanyDialog: false,
    }
  },

  computed: {
    toDate () {
      return (value) => {
        if (value === '' || value === null)
          return ''

        return moment(value).format('YYYY-MM-DD')
      }
    },
    ...mapGetters('profile', ['profile']),
    ...mapGetters('company', ['company']),
  },
  async created () {
    this.loading = true
    await this.getCompany()
    this.loading = false
  },

  methods: {
    closeEditCompany () {
      this.showCompanyDialog = false
    },
    onEditCompany () {
      this.showCompanyDialog = true
    },
    ...mapActions({
      getCompany: 'company/show',
    }),
  },
}
</script>

<style scoped>

</style>
