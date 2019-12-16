export default {
    state: {
        listProducts: {data:[]},
        product: {}
    },
    mutations: {
        updateProductsList(state, data) {
            state.listProducts = data;
        },
        updateProduct(state, data) {
            state.product = data;
        }
    },
    actions: {
        getProducts(context, message_id) {
            return window.axios.get(`api/v1/products`)
            .then(response => {
                context.commit('updateProductsList', response.data)
                return response;
            })
            
        },
        getProduct(context, id) {
            return window.axios.get(`api/v1/products/${id}`)
            .then(response => {
                context.commit('updateProduct', response.data)
            })
        },
        newProduct(context, data) {
            return window.axios.post('api/v1/products', data,
            {
                headers: {"content-type": "multipart/form-data"}
            })
        },
        updateProduct(context, data) {
            return window.axios.post(`api/v1/products/${data.id}`, data.data,
            {
                headers: {"content-type": "multipart/form-data"}
            })
        },
        removeProduct(context, id) {
            return window.axios.delete(`api/v1/products/${id}`)
        },
    }
}
