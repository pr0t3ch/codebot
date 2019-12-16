<template>
    <div>
        <h3>Produtos</h3>
        <div v-if="products.data.length > 0">
            <div
                v-bind:key="product.title"
                class="card horizontal"
                v-for="product in products.data"
            >
                <div class="card-image">
                    <img :src="product.image_full_url" />
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span>{{ product.title }}</span>
                        <p>{{ product.subtitle }}</p>
                        <p>
                            <a
                                :href="product.url"
                                target="_blank"
                                title="ver pagina do produto"
                            >{{ product.url }}</a>
                        </p>
                    </div>
                    <div class="card-action">
                        <a :href="`#/product/${product.id}/edit`">editar</a>
                        <a :href="`#/product/${product.id}/remove`">remover</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card red" v-if="products.data.length === 0">
            <div class="card-content white-text">Nenhum produto</div>
        </div>

        <hr />

        <form enctype="multipart/form-data" @submit.prevent="save()">
            <h5>Novo produto</h5>

            <div v-if="!newProduct">
                <a href class="waves-effect waves-light btn" @click.prevent="newProduct = true">+</a>
            </div>

            <div v-if="newProduct">
                <div class="input-field">
                    <input type="text" placeholder="Título" v-model="product.title" required />
                </div>

                <div class="input-field">
                    <input type="text" placeholder="Sub-título" v-model="product.subtitle" required />
                </div>

                <div class="input-field file-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" required @change="imageUploader($event) " />
                    </div>
                    <div class="file-path-wrapper">
                        <input type="text" class="file-path validate" placeholder="Imagem..." />
                    </div>

                    <div class="input-field">
                        <input
                            type="text"
                            placeholder="Link do produto"
                            v-model="product.url"
                            required
                        />
                    </div>

                    <button type="submit" class="waves-effect waves-light btn">+</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            product: {},
            newProduct: false,
        }
    },
    methods: {
        save() {
            let data = new FormData();
            data.append('title', this.product.title);
            data.append('subtitle', this.product.subtitle);
            data.append('image_url', this.product.image_url);
            data.append('url', this.product.url);

            console.log(this.product.image_url);

            this.$store.dispatch('newProduct', data).then(() => {
                this.$store.dispatch('getProducts');
                this.product = {};
                this.newProduct = false;
            })

        },
        imageUploader($event) {
            if($event.target.files.length > 0) {
                this.product.image_url = $event.target.files[0];
            }

        }
    },
    computed: {
        products() {
            return this.$store.state.product.listProducts;
        }
    },
    mounted() {
        this.$store.dispatch('getProducts')
    }
    
}
</script>