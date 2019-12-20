import Postback from './components/Bot/Postback.vue'
import PostbackView from './components/Bot/PostbackView.vue'
import Login from './components/Auth/Login.vue'
import Register from './components/Auth/Register.vue'
import ProductsList from './components/Products/ProductsList';
import ProductRemove from './components/Products/ProductRemove';
import ProductEdit from './components/Products/ProductEdit';
import SuggestionList from './components/Suggestions/SuggestionList';
import Menus from './components/Menus/Menu';
import MenuView from './components/Menus/MenuView';

export default [

    { path: '/login', component: Login, meta: { requiresAuth: false } },
    { path: '/register', component: Register, meta: { requiresAuth: false } },

    { path: '/', component: Postback, meta: { requiresAuth: true } },
    { path: '/postback/:id', component: PostbackView, meta: { requiresAuth: true } },
    { path: '/products', component: ProductsList, meta: { requiresAuth: true } },
    { path: '/product/:id/remove', component: ProductRemove, meta: { requiresAuth: true } },
    { path: '/product/:id/edit', component: ProductEdit, meta: { requiresAuth: true } },
    { path: '/menus', component: Menus, meta: { requiresAuth: true } },
    { path: '/menu/:id', component: MenuView, meta: { requiresAuth: true } },

    { path: '/suggestions/', component: SuggestionList, meta: { requiresAuth: true } },
]