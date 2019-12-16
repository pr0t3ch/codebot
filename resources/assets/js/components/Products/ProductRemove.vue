<template>
    <div>
        <h3>Remover produto</h3>

        <div class="card orange white-text">
            <div class="card-content">Você não poderá desfazer esta ação. Tem certeza?</div>
        </div>

        <p>
            <a href="#/products" class="btn red">Não quero remover</a>
            <a href class="btn green" @click.prevent="remove()">Quero remover</a>
        </p>
    </div>
</template>

<script>
export default {
    methods: {
        remove: function() {
            this.$store.dispatch('removeProduct', this.$route.params.id)
            .then(() => {
                this.$router.push({path: '/products'});
            })
        }
    },
    computed: {
        product() {
            return this.$store.state.product.product
        }
    },
    mounted() {
        this.$store.dispatch('getProduct', this.$route.params.id)
    }
    
}
</script>