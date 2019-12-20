export default {
    state: {
        listMenuButtons: {data:[]},
        menu_button: {}
    },
    mutations: {
        updateMenuButtonList(state, data) {
            state.listMenuButtons = data;
        },
        updateMenuButton(state, data) {
            state.menu_button = data;
        }
    },
    actions: {
        getMenuButtons(context) {
            return window.axios.get('api/v1/menu-button')
            .then(response => {
                context.commit('updateMenuButtonList', response.data)
            })
        },
        getMenuButton(context, id) {
            return window.axios.get(`api/v1/menu-button/${id}`)
            .then(response => {
                context.commit('updateMenuButton', response.data)
            })
        },
        newMenuButton(context, data) {
            return window.axios.post('api/v1/menu-button', data)
        },
        updateMenuButton(context, data) {
            return window.axios.put(`api/v1/menu-button/${data.id}`, data.data)
        },
        removeMenuButton(context, id) {
            return window.axios.delete(`api/v1/menu-button/${id}`)
        },
        sentToFacebook(context, id) {
            return window.axios.get(`api/v1/set-menu/${id}`)
        },
        removeFromFacebook(context) {
            return window.axios.get(`api/v1/remove-menu`)
        },
    }
}
