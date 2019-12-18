<template>
    <div class="card">
        <span class="green white-text badge">{{ message.type }}</span>
        <div class="card-content">
            <blockquote>
                <strong>Mensagem:</strong>
                {{ message.message }}
            </blockquote>
            <img :src="message.message" v-if="message.type === 'image'" class="responsive-img" />

            <audio controls v-if="message.type === 'audio'">
                <source :src="message.message" />
            </audio>
            <div v-if="message.type === 'video'" class="video-container">
                <video style="max-width: 100%" controls>
                    <source :src="message.message" />
                </video>
            </div>

            <blockquote v-if="message.type === 'file'">
                <a :href="message.message">
                    <i class="material-icons">attach_file</i>
                    Arquivo para download
                </a>
            </blockquote>

            <buttons v-if="message.type === 'buttons'" :message-data="message"></buttons>
            <generic v-if="message.type === 'generic'" :message-data="message"></generic>
            <list v-if="message.type === 'list'" :message-data="message"></list>

            <form @submit.prevent="update(currentMessage)" v-if="showEditForm">
                <div class="input-field">
                    <input
                        type="text"
                        class="form-control"
                        autofocus
                        v-model="currentMessage"
                        required
                    />
                    <label for="active">Mensagem</label>

                    <input type="submit" value="Atualizar" class="btn" />
                    <input
                        type="button"
                        value="Cancelar"
                        class="btn lime"
                        @click.prevent="showEditForm = !showEditForm;"
                    />
                </div>
            </form>
        </div>

        <div class="card-action">
            <a
                href
                @click.prevent="showEditForm = !showEditForm;
            currentMessage = message.message"
            >editar</a>
            <a href @click.prevent="remove(message.id)">remover</a>
        </div>
    </div>
</template>


<script>
import Buttons from './Templates/Buttons';
import Generic from './Templates/Generic';
    export default {
        props: [
            'messageData'
        ],
        components: {
            buttons: Buttons,
            generic: Generic,
            list: Generic
        },
        data: function() {
            return {
                currentMessage: null,
                showEditForm: false
            }
        },
        methods: {
            update: function(message) {
                let data = {
                    id: this.message.id,
                    data: {
                        type: this.message.type,
                        message: message
                    }
                }

                this.$store.dispatch('updateMessage', data)
                .then(() => {
                    swal('Salvo com sucesso', 'O bot já responde com essa atualização', 'success')
                    this.message.message = message;
                    this.showEditForm = false;
                    this.$store.dispatch('getPostback', this.$route.params.id)
                })
            },
            remove: function(id) {

                let item = this;
                swal({
                    title: "Removendo",
                    text: "Você está removendo esta mensagem",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                }).then(function(isConfirm) {
                if (isConfirm) {
                    item.removeItens(id)
                    } 
                })

                
            },
            removeItens(id) {
               this.$store.dispatch('removeMessage', id)
                .then(() => {
                    swal('Removido com sucesso', 'O bot já não responde', 'success')
                    this.$store.dispatch('getPostback', this.$route.params.id)
                })

            },
            
        },
        computed : {
            message: function() {
                return this.messageData
            }

        }
    }
</script>