const state = {
  isModalOpen: false,
  modalType: null,
  taskToEdit: null
}

export const getters = {
  modal: state => state
}

const mutations = {
  openModal (state, { type, task }) {
    state.isModalOpen = true
    state.modalType = type
    state.taskToEdit = task
  },
  closeModal (state) {
    state.isModalOpen = false
    state.modalType = null
    state.taskToEdit = null
  }
}

const actions = {
  openModal ({ commit }, { type, task }) {
    commit('openModal', { type, task })
  },
  closeModal ({ commit }) {
    commit('closeModal')
  }
}

export default {
  namespaced: true, // Optional, but recommended for modularity
  state,
  mutations,
  actions,
  getters
}
