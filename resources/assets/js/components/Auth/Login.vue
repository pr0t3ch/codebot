<template>
    <div class="row">
        <div class="col s6 push-s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Acessar</span>
                    <form @submit.prevent="login()">
                        <div class="input-field">
                            <label for="email">E-mail</label>
                            <input
                                type="email"
                                id="name"
                                name="email"
                                required
                                autofocus
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

                        <div>
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                v-model="credentials.remember"
                            />

                            <label name="remember">Lembrar de mim</label>
                        </div>

                        <hr />
                        <button type="submit" class="btn">Login</button>

                        <a href="#/register" class="btn">Registrar</a>
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
            login() {
                window.axios.post('/login', this.credentials)
                .then((res) => {
                    if(res.data.status === 'success') {
                        swal('Autenticado com succeso', '', 'success');
                        this.$router.push({path: '/'})
                    }
                })
                .catch(() => {
                   
                    swal('Usuário e senha invalido', '', 'error');
                    
                });
            }
        }
    }
</script>
