import {createStore} from "vuex";
import axiosClient from "../axios.js";

const store = createStore({
    state: {
        user: {
            data: [],
            token: sessionStorage.getItem("TOKEN"),
        },
        deals: {
            data: []
        },
        accounts: {
            data: []
        }
    },
    getters: {},
    actions: {
        register({commit}, user) {
            return axiosClient.post('/register', user)
                .then(({data}) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token)
                    return data;
                })
        },
        login({commit}, user) {
            return axiosClient.post('/login', user)
                .then(({data}) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token);
                    return data;
                })
        },
        logout({commit}) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout')
                    return response;
                })
        },
        getDeals({commit}) {
            return axiosClient.get('/deals')
                .then((response) => {
                    commit('setDeals', response);
                    return response;
                })
        },
        deleteDeal({dispatch}, deal) {
            return axiosClient.delete(`/deals/${deal.id}`)
                .then((res) => {
                    dispatch('getDeals')
                    return res;
                });
        },
        saveDeal({commit, dispatch}, deal) {
            if (deal.id) {
                return axiosClient.put(`/deals/${deal.id}`, deal)
                    .then(({data}) => {
                        commit('setDeals', data);
                        return data;
                    })
            } else {
                return axiosClient.post(`/deals`, deal)
                    .then(({data}) => {
                        commit('setDeals', data);
                        return data;
                    })
            }
        },
        getAccounts({commit}) {
            return axiosClient.get('/accounts')
                .then((response) => {
                    commit('setAccounts', response);
                    return response;
                })
        },
        deleteAccount({dispatch}, id) {
            return axiosClient.delete(`/accounts/${id}`)
                .then((res) => {
                    dispatch('getAccounts')
                    return res;
                });
        },
        createAccount({commit}, account) {
            return axiosClient.post(`/deals/${account}`, account)
                .then(({data}) => {
                    commit('setAccounts', data);
                    return data;
                })
        },
        getDashboardContent({commit}) {
            return axiosClient.get('/dashboard')
                .then((response) => {
                    commit('setDashboardData', response.data)
                    return response;
                });
        }
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.removeItem('TOKEN')
        },
        setUser: (state, user) => {
            state.user.data = user;
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setAccessToken: (state, token) => {
            sessionStorage.setItem('ACCESS_TOKEN', token);
        },
        setDeals: (state, deals) => {
            state.deals.data = deals;
        },
        setAccounts: (state, accounts) => {
            state.accounts.data = accounts;
        },
        setDashboardData: (state, data) => {
            state.accounts.data = data.accounts.original.accounts;
            state.deals.data = data.deals.original.deals;
        }
    },
    modules: {}
});

export default store;
