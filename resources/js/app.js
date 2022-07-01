require('./bootstrap');

// import vue
import { createApp } from 'vue'
// import component
import AppCom from './components/exampleComponent';
import ProductAdd from './components/product/ProductAdd';
import ProductEdit from './components/product/ProductEdit';
import StockManage from './components/stock/StockManage';
import ReturnProduct from './components/returnProduct/ReturnProduct';
import store from './store';

const app = createApp({});

app.component("ProductAdd", ProductAdd);
app.component("ProductEdit", ProductEdit);
app.component("StockManage", StockManage);
app.component("ReturnProduct", ReturnProduct);


app.use(store).mount('#app')

