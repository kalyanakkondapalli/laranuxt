import type { GetterTree, ActionTree, MutationTree } from 'vuex'

export interface RootState {
  
}

const actions: ActionTree<RootState, RootState>= {
  async update ({ commit, dispatch }, data) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const response = await this.$axios.post(`api/about/${data.id}`, data)
      commit('profile/SET_PROFILE', response.data.data, {root: true})
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
