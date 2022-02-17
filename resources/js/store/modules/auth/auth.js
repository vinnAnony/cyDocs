const user = JSON.parse(localStorage.getItem('user'));


export const auth = {
    namespaced: true,
    state: {
        status: {
            loggedIn: user ? true : false
        },

        user: user
    },

    getters: {
        authState: state => state.status,
        user: state => state.user,
    },

    actions: {
        login({commit},data) {
            //localStorage.setItem('user', JSON.stringify(user));
            console.log(data)
            if (data.token) {
                localStorage.setItem('cyDocsToken', JSON.stringify(data.token));
                localStorage.setItem('user', JSON.stringify(data.user));
            }
            commit('login',data.user);
        },
        logout({ commit }) {
            localStorage.clear();
            commit('logout');
        },
    },
    mutations: {
        logout(state) {
            state.status.loggedIn = false;
            state.user = {};
        },
        login(state,user) {
            state.status.loggedIn = true;
            state.user = user;
        },
    }
};
