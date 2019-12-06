<template>
    <div class="row">
        <div class="col s6 push-s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Acessar</span>
                    <form @submit.prevent="register()">
                        <div class="input-field">
                            <label for="email">Nome</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                autofocus
                                v-model="credentials.name"
                            />
                        </div>
                        <div class="input-field">
                            <label for="email">E-mail</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                v-model="credentials.email"
                            />
                        </div>
                        <div class="input-field">
                            <label for="password">Senha</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                v-model="credentials.password"
                            />
                        </div>
                        <div class="input-field">
                            <label for="password">Confirmar senha</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                v-model="credentials.password_confirmation"
                            />
                        </div>

                        <hr />
                        <button type="submit" class="btn">Registar</button>
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
                credentials: {}
            }
        },
        methods: {
            register() {
                if(this.credentials.password !== this.credentials.password_confirmation) {
                    swal('Verifique a senha', 'A senha não confere', 'error');
                } else {
                    window.axios.post('/register', this.credentials)
                    .then((res) => {
                        if(res.data.status === 'success') {
                            swal('Cadastro feito com sucesso', '', 'success');
                            this.$router.push({path: 'login'})
                        }

                    })
                    .catch(() => {
                    
                        swal('Erro no cadastro', '', 'error');
                        
                    });
                }
                
            }
        }
    }
</script>
