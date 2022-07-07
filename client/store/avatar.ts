import type { GetterTree, ActionTree, MutationTree } from 'vuex'

export interface RootState {
    avatar: string|null
}

const state = (): RootState => ({
  avatar: null,
})

const getters: GetterTree<RootState, RootState> = {
  avatar: (state): string | null => state.avatar,
}

const mutations: MutationTree<RootState> = {
  SET_AVATAR: (state, data: any) => { state.avatar = data },
}

const actions: ActionTree<RootState, RootState> = {
  async upload ({ commit, dispatch }, data) {
    try {
      commit('errors/CLEAR', null, { root: true })
      const formData = new FormData()
      formData.append('avatar', data.avatar)
      const response = await this.$axios.post(`api/avatar/${data.id}`, formData)
      commit('SET_AVATAR', response.data.data.avatar)
      commit('profile/SET_PROFILE', response.data.data, { root: true})
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
