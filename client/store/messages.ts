import type { GetterTree, MutationTree } from 'vuex'

export interface RootState {
    message: string | null
}

const state = (): RootState => ({
  message: null,
})

const getters: GetterTree<RootState, RootState> = {
  message: (state): string | null => state.message,
}

const mutations: MutationTree<RootState> = {
  SET_MESSAGE: (state, message: any) => {
    state.message = message
  },
}

export default {
  namespaced: true,
  mutations,
  getters,
  state,
}
