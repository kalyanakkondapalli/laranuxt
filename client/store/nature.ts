import type { ActionTree } from 'vuex'

export interface RootState {
    nature: string
}

const actions: ActionTree<RootState, RootState> = {
  async update ({ commit, dispatch }, data) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.post(`api/nature/${data.id}`, data)
      commit('profile/SET_PROFILE', response.data.data, { root: true })
      commit('messages/SET_MESSAGE', response.data.message, { root: true })
    } catch (e:any) {
      await dispatch('errors/errorResponse', e.response, { root: true })
    }
  },
}

export default {
  namespaced: true,
  actions,
}
