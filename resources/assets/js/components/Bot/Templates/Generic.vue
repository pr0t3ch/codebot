<template>
    <div>
        <div v-if="products.length > 0">
            <div v-bind:key="product.id" v-for="product in products" class="chip">
                {{ product.title }}
                <a
                    class="btn-floating red"
                    @click.prevent="removeProduct(product.id)"
                >
                    <i class="material-icons">close</i>
                </a>
            </div>
        </div>
        <div class="card red" v-if="products.length === 0">
            <div class="card-content white-text">Nenhum produto</div>
        </div>

        <form class="grey lighten-4" @submit.prevent="newProduct()">
            <strong>Novo produto</strong>
            <div class="input-field">
                <select v-model="newProductData" class="browser-default">
                    <option value disabled selected>Escolha um produto</option>
                    <option
                        v-bind:key="product.title"
                        v-for="product in productsList.data"
                        :value="product"
                    >{{ product.title }}</option>
                </select>
            </div>
            <button type="submit" class="btn">+</button>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'messageData'
    ],
    data: function() {
        return {
            message: this.messageData,
            dataToSave:{},
            newProductData: '',
            products: []
        }
    },
    methods: {
        newProduct: function() {
            let data = {
                id: this.message.id,
                product_id: this.newProductData.id
            };
            this.$store.dispatch('setMessageProduct', data).then(() => {
                this.$store.dispatch('getMessageProduct', this.message.id)
                .then(res => {
                    this.products = res.data;
                    this.newProductData = '';
                })
            })
        },
        removeProduct: function(productId) {
            let data = {
                id: this.message.id,
                product_id: productId
            };

            this.$store.dispatch('removeMessageProduct', data).then(() => {
                this.$store.dispatch('getMessageProduct', this.message.id).then(res => {
                    this.products = res.data
                })
            })
        }
    },
    computed: {
        productsList() {
            return this.$store.state.product.listProducts;
        }
    },
    mounted() {
        this.$store.dispatch('getProducts');
        this.$store.dispatch('getMessageProduct', this.message.id)
        .then(res => {
            this.products = res.data;
        })
    }
}
</script>

<style lang="css">
    form {
        margin-top: 40px;
        padding: 10px;
        border-radius: 2px;
    }
</style>