import { createStore } from 'vuex'

export default createStore({
  state: {
    url: "",
  },
  mutations: {
    setUrl(state, value){
      state.url = value;
    }
  },
  actions: {
    setUrl({ commit }, value){
      commit('setUrl', value);
    }
  },
  modules: {
  }
})
