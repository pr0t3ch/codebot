import postbacks from './modules/postbacks';
import messages from './modules/messages';
import elements from './modules/elements';
import products from './modules/products';
import menus from './modules/menus';

export default {
    modules: {
        postback: postbacks,
        messages: messages,
        elements: elements,
        product: products,
        menu: menus
    }
}