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
        <message
            v-bind:key="message.id"
            v-for="message in postback.messages"
            :message-data="message"
        ></message>

        <div class="card light-green">
            <div class="card-content">
                <form @submit.prevent="newMessage()">
                    <h5>Nova mensagem</h5>
                    <div class="input-field">
                        <select class="browser-default" required v-model="dataToSave.type">
                            <option value disabled>Tipo de mensagem</option>
                            <optgroup label="Mensagem">
                                <option value="text">Texto</option>
                                <option value="file">Arquivo</option>
                                <option value="audio">Audio</option>
                                <option value="image">Imagem</option>
                                <option value="video">Vídeo</option>
                            </optgroup>
                            <optgroup label="Templates">
                                <option value="buttons">Botões</option>
                                <option value="generic">Slider</option>
                                <option value="list">Lista de produtos</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="input-field messageField">
                        <input type="text" required v-model="dataToSave.message" />
                        <label>Mensagem</label>
                    </div>
                    <input type="submit" value="+" class="btn green messageSave" />
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import swal from 'sweetalert';
import message from './Message'
    export default {
        components: {
            'message': message
        },
        data: function() {
            return {
                showEditForm: false,
                dataToSave : {
                    type: '',
                    message: ''
                }
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
                    swal('Salvo com sucess', 'O bot já entende o postback', 'success')
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

            },
            newMessage() {
                const $ = window.jQuery;
                $('.messageSave').val('aguarde...').attr('disabled', true);

                let data = {
                    type: this.dataToSave.type || 'text',
                    message: this.dataToSave.message,
                    template: false,
                    postback_id: this.$route.params.id
                }

                let messageTypes = [
                    'text',
                    'file',
                    'audio',
                    'image',
                    'video',
                ]

                if(messageTypes.indexOf(data.type) === -1) {
                    data.template= true;
                }

                this.$store.dispatch('newMessage', data)
                .then(() => {
                    $('.messageSave').val('+').attr('disabled', false);
                    swal('Salvo com sucesso', 'O bot já deve responder', 'success');
                    this.dateToSave = {type: 'text'};
                    this.$store.dispatch('getPostback',this.$route.params.id)
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

<style lang="scss">
    .messageField {
        background-color: rgba(255,255,255,0.9);
        margin-bottom: 20x;
        padding: 20px;
        border-radius: 2px;

        input {
            margin-bottom: 0;
            border-bottom: none;
        }

        label {
            left: 10px;
        }
    }
</style>