export default {
    namespaced: true,
    state: {
        cycleTimes: [],
    },
    mutations: {
        setCycleTimes(state, value){
            state.cycleTimes = value;
        }
    },
    actions: {
        setCycleTimes({ commit }, value){
            commit('setCycleTimes', value);
        }
    }
}