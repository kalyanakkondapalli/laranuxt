import type { GetterTree, ActionTree, MutationTree } from 'vuex'

export interface CompanyInterface {
  id: number
  company_name: string
  state_date: Date,
  end_date: Date,
  role: string|null,
  job_nate: string|null
  is_current_working: boolean
  created_at?: Date
  updated_at?: Date
}

export interface RootState {
    company: CompanyInterface
}

const state = (): { company: null } => ({
  company: null,
})

const getters: GetterTree<RootState, RootState> = {
  company: (state): CompanyInterface => state.company,
}

const mutations: MutationTree<RootState> = {
  SET_COMPANY: (state, data: any) => { state.company = data },
}

const actions: ActionTree<RootState, RootState> = {
  async show ({ commit, dispatch }) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.get('api/company')
      commit('SET_COMPANY', response.data.data)
    } catch (e:any) {
      await dispatch('errors/errorResponse', e.response, { root: true })
    }
  },
  async update ({ commit, dispatch }, { id, data }) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.put(`api/company/${id}`, data)
      commit('SET_COMPANY', response.data.data)
      commit('messages/SET_MESSAGE', response.data.message, { root: true })
    } catch (e:any) {
      await dispatch('errors/errorResponse', e.response, { root: true })
    }
  },
}

export default {
  namespaced: true,
  actions,
  mutations,
  getters,
  state,
}
