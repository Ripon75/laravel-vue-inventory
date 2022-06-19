require('./bootstrap');

// import vue
import { createApp } from 'vue'
// import component
import AppCom from './components/exampleComponent';
import ProductAdd from './components/product/ProductAdd';
import ProductEdit from './components/product/ProductEdit';
import store from './store';

const app = createApp({});

app.component("ProductAdd", ProductAdd);
app.component("ProductEdit", ProductEdit);

// app
// .component('ProductAdd', ProductAdd)
// .component('AppCom', AppCom)

// App.mount('#app')
app.use(store).mount('#app')

