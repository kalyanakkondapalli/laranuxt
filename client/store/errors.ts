import type { ActionTree, GetterTree, MutationTree } from 'vuex'

export interface RootState {
    error: string | null
    errors: Object,
    status: number
}

const state = (): RootState => ({
  error: null,
  errors: Object,
  status: 500,
})

const getters: GetterTree<RootState, RootState> = {
  error: (state): string | null => state.error,
  errors: (state): Object => state.errors,
}

const mutations: MutationTree<RootState> = {
  SET_ERROR: (state, error: any) => {
    state.error = error
  },

  SET_ERRORS: (state, errors: []) => {
    state.errors = errors
  },

  SET_STATUS: (state, status: number) => {
    state.status = status
  },

  CLEAR: (state) => {
    state.errors = {}
    state.error = null
  }
}

export const actions: ActionTree<RootState, RootState> = {
  // error response
  errorResponse: ({ commit }, errorResponse) => {
    if (errorResponse && errorResponse.status) {
      const errorStatusCode = errorResponse.status
      const errorData: any = {}
      commit('SET_STATUS', errorResponse.status)
      switch (errorStatusCode) {
        case 422:
          if (errorResponse.data.errors) {
            Object.keys(errorResponse.data.errors).forEach((key) => {
              errorData[key] =
                  errorResponse.data.errors[key][0]
            })
            commit('SET_ERRORS', errorData)
          }
          commit('SET_ERROR', errorResponse.data.message)
          break
        case 400:
          errorData.error = errorResponse.data.data.message
          commit('SET_ERROR', errorData.error)
          break
        case 403:
          errorData.error = errorResponse.data.message
          commit('SET_ERROR', errorResponse.data.message)
          break
        case 405:
          errorData.error = errorResponse.data.data.message
          commit('SET_ERROR', errorResponse.data.data.message)
          break
        case 429:
          errorData.error = 429
          commit('SET_ERROR', 429)
          break
        default:
          if (errorResponse.data.message) {
            commit('SET_ERROR', errorResponse.data.message)
            errorData.error = errorResponse.data.message
          } else if (errorResponse.data.data.message) {
            commit('SET_ERROR', errorResponse.data.data.message)
            errorData.error = errorResponse.data.data.message
          } else {
            commit('SET_ERROR', errorResponse.data.data.message)
            errorData.error = errorResponse.data.data.error
          }
          break
      }
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
