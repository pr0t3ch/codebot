export default {
    state: {
        listElements: {data:[]},
        Elements: {}
    },
    mutations: {
        updateElementsList(state, data) {
            state.listElements = data;
        },
        updatePostback(state, data) {
            state.postback = data;
        }
    },
    actions: {
        getElements(context, message_id) {
            return window.axios.get(`api/v1/elements?where[message_id]=${message_id}`)
            .then(response => {
                context.commit('updatePostbackList', response.data)
                return response;
            })
            
        },
        getElement(context, id) {
            return window.axios.get(`api/v1/elements/${id}`)
            .then(response => {
                context.commit('updateElement', response.data)
            })
        },
        newElement(context, data) {
            return window.axios.post('api/v1/elements', data)
        },
        updateElement(context, data) {
            return window.axios.put(`api/v1/elements/${data.id}`, data.data)
        },
        removeElement(context, id) {
            return window.axios.delete(`api/v1/elements/${id}`)
        },
    }
}
