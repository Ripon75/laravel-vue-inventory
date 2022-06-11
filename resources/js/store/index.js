import {createStore} from 'vuex'

// import category index
import categories from './modules/category'
// import brand index
import brands from './modules/brand'

const store = createStore({
   modules: {
     categories,
     brands
    }
})

export default store