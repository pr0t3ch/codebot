<template>
    <div>
        <h3>Edição de produtos</h3>

        <div class="card horizontal">
            <div class="card-image" v-if="preview">
                <img :src="preview" />
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title">{{product.title}}</span>
                    <form enctype="multipart/form-data" @submit.prevent="save()">
                        <h5>Editar produto</h5>

                        <div class="input-field">
                            <input
                                type="text"
                                placeholder="Título"
                                v-model="product.title"
                                required
                            />
                        </div>

                        <div class="input-field">
                            <input
                                type="text"
                                placeholder="Sub-título"
                                v-model="product.subtitle"
                                required
                            />
                        </div>

                        <div class="input-field file-field">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" @change="imageUploader($event) " />
                            </div>
                            <div class="file-path-wrapper">
                                <input
                                    type="text"
                                    class="file-path validate"
                                    placeholder="Imagem..."
                                />
                            </div>

                            <div class="input-field">
                                <input
                                    type="text"
                                    placeholder="Link do produto"
                                    v-model="product.url"
                                    required
                                />
                            </div>

                            <button type="submit" class="waves-effect waves-light btn">salvar</button>
                            <a href="#/products" class="btn grey lighten-4 black-text">voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert';
export default {
   
    data: function() {
        return {
            preview: null,
        }
    },
    methods: {
        save() {
            let data = new FormData();
            data.append('title', this.product.title);
            data.append('subtitle', this.product.subtitle);
            data.append('image_url', this.product.image_url);
            data.append('url', this.product.url);
            data.append('_method', 'PUT');

            this.$store.dispatch('updateProduct', {id: this.$route.params.id, data}).then(() => {
                this.$store.dispatch('getProduct', this.$route.params.id)
                swal('Salvo com sucesso', 'O produto foi atualizado', 'success')
            })

        },
        imageUploader($event) {
            if($event.target.files.length > 0) {
                this.product.image_url = $event.target.files[0];
            }

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