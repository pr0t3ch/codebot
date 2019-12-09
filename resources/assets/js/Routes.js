import Postback from './components/Bot/Postback.vue'
import PostbackView from './components/Bot/PostbackView.vue'
import Login from './components/Auth/Login.vue'
import Register from './components/Auth/Register.vue'

export default [
    
    { path: '/login', component: Login, meta: { requiresAuth : false }},
    { path: '/register', component: Register, meta: { requiresAuth : false }},
    
    { path: '/', component: Postback, meta: { requiresAuth : true }},
    { path: '/postback/:id', component: PostbackView, meta: { requiresAuth : true }},
]