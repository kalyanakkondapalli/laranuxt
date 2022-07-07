import type { GetterTree, ActionTree, MutationTree } from 'vuex'

export interface ProfileInterface {
  id: number
  name: string
  email: string,
  avatar: string|null,
  description: string|null
  about_me: string|null
  nature: string|null
  skills: string[]
}

export interface RootState {
    profile: ProfileInterface
}

const state = (): { profile: null } => ({
  profile: null,
})

const getters: GetterTree<RootState, RootState> = {
  profile: (state): ProfileInterface => state.profile,
}

const mutations: MutationTree<RootState> = {
  SET_PROFILE: (state, data: any) => { state.profile = data },
}

const actions: ActionTree<RootState, RootState> = {
  async show ({ commit, dispatch }) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.get('api/profile')
      commit('SET_PROFILE', response.data.data)
    } catch (e:any) {
      await dispatch('errors/errorResponse', e.response, { root: true })
    }
  },
  async update ({ commit, dispatch }, { id, data }) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.put(`api/profile/${id}`, data)
      commit('SET_PROFILE', response.data.data)
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
