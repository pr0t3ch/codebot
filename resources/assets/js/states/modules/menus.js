export default {
    state: {
        listMenus: {data:[]},
        Menu: {}
    },
    mutations: {
        updateMenuList(state, data) {
            state.listMenus = data;
        },
        updateMenu(state, data) {
            state.menu = data;
        }
    },
    actions: {
        getMenus(context) {
            return window.axios.get('api/v1/menus')
            .then(response => {
                context.commit('updateMenuList', response.data)
            })
        },
        getMenu(context, id) {
            return window.axios.get(`api/v1/menus/${id}`)
            .then(response => {
                context.commit('updateMenu', response.data)
            })
        },
        newMenu(context, data) {
            return window.axios.post('api/v1/menus', data)
        },
        updateMenu(context, data) {
            return window.axios.put(`api/v1/menus/${data.id}`, data.data)
        },
        removeMenu(context, id) {
            return window.axios.delete(`api/v1/menus/${id}`)
        },
    }
}
