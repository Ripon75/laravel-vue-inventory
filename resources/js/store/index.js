import {createStore} from 'vuex'

import categories from './modules/category'

const store = createStore({
   modules: {
     categories
    }
})

export default store