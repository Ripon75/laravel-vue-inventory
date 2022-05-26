require('./bootstrap');

// import vue
import { createApp } from 'vue'
// import component
import AppCom from './components/exampleComponent';
import ProductAdd from './components/product/ProductAdd';

const app = createApp({})

app
.component('ProductAdd', ProductAdd)
.component('AppCom', AppCom)

app.mount('#app')

