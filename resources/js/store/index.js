// store.js

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import categories from './modules/category'

export default new Vuex.Store({
    modules: {
      categories
    }
});