require('./bootstrap');

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();



import { createApp } from 'vue'
import AppCom from './components/exampleComponent';

const app = createApp({})

app.component('AppCom', AppCom)

app.mount('#app')