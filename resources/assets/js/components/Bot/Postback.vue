<template>
    <div>
        <h3>Postbacks</h3>
        <router-link
            v-bind:key="postback.id"
            v-for="postback in postbacks.data"
            class="waves-effect btn waves-light light-green"
            :to="{path: `/postback/${postback.id}`}"
        >{{ postback.value }}</router-link>

        <hr />

        <form @submit.prevent="save()">
            <div class="input-field">
                <input id="value_postback" type="text" v-model="title" required />
                <label for="value_postback">Identificação do postback</label>
            </div>
            <input type="submit" value="+" class="btn" />
        </form>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                title: ''
            }
        },
        computed: {
            postbacks() {
                return this.$store.state.postback.listPostbacks
            }
        },
        methods: {
            save() {
                this.$store.dispatch('newPostback', {'value': this.title}).then(() => {
                    this.$store.dispatch('getPostbacks')
                    this.title = ''
                })
            }
        },
        mounted() {
            this.$store.dispatch('getPostbacks')
        }
    }

</script>