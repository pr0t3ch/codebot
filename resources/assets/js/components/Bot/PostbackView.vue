<template>
    <div>
        <h3>
            <small>postback:</small>
            {{ postback.value }}
        </h3>
        <form @submit.prevent="save()" v-if="showEditForm">
            <div class="input-field">
                <input id="value_postback" type="text" v-model="postback.value" autofocus required />
            </div>
            <input type="submit" value="Editar" class="btn" />
        </form>
        <p>
            <router-link :to="{path: '/'}" class="btn waves-effect">Voltar</router-link>
            <a
                @click.prevent="addGetStarted()"
                href
                v-if="!postback.get_started"
                class="btn green"
            >Definir como padrão</a>
            <a
                @click.prevent="removeGetStarted()"
                href
                v-if="postback.get_started"
                class="btn red"
            >Remover do padrão</a>
            <a
                class="btn blue waves-effect"
                @click.prevent="showEditForm = !showEditForm"
                href
            >editar</a>
            <a class="btn red waves-effect" @click.prevent="remove()" href>remover</a>
        </p>
    </div>
</template>

<script>
import swal from 'sweetalert';
    export default {
        data: function() {
            return {
                showEditForm: false,
            }
        },
        methods: {
            save() {
                let data = {
                    id: this.$route.params.id,
                    data: {
                        value: this.postback.value
                    }
                }
                this.$store.dispatch('updatePostback', data)
                .then(() => {
                    swal('Salvo com sucess', 'O bot já entende o postack', 'success')
                    this.showEditForm = false
                })
            },
            remove() {
                let item = this;
                swal({
                    title: "Removendo",
                    text: "Você está removendo este postback",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                }).then(function(isConfirm) {
                if (isConfirm) {
                    item.removeItens()
                    } 
                })
            },
            removeItens() {
                this.$store.dispatch('removePostback', this.$route.params.id)
                    .then(() => {
                        swal("Removido", "Removido com sucesso", "success")
                        this.$router.push("/")
                    })

            },
            addGetStarted() {
                let item = this;
                swal({
                    title: "Definir como padrão?",
                    text: "Este botão será o padrão do bot",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                }).then(function(isConfirm) {
                if (isConfirm) {
                    item.addItemGetStarted()
                    } 
                })
            },
            addItemGetStarted() {
                this.$store.dispatch('addGetStarted', this.$route.params.id)
                    .then(() => {
                        swal("Adicionado", "Adicionado com sucesso", "success")
                    })
                this.$store.dispatch('getPostback',this.$route.params.id)

            },
            removeGetStarted() {
                let item = this;
                swal({
                    title: "Retirar como padrão?",
                    text: "Este será retirado do bot",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                }).then(function(isConfirm) {
                if (isConfirm) {
                    item.removeItemGetStarted()
                    } 
                })
            },
            removeItemGetStarted() {
                this.$store.dispatch('removeGetStarted', this.$route.params.id)
                    .then((res) => {
                        let err = res.data.error || null;
                        if(err) {
                            let message = "Algo deu errado";
                            if(err.code === 100) {
                                message = 'Você precisa manter o botão começar'
                            }
                            swal("Erro", message, "error")
                        } else {
                            swal("Botão desativado", "Adicione novamente", "success")
                        }
                        
                    })

            }
        },
        computed: {
            postback() {
                return this.$store.state.postback.postback
            }
        },
        mounted() {
            this.$store.dispatch('getPostback',this.$route.params.id)
        }
    }
</script>