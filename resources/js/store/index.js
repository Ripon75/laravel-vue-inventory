import {createStore} from 'vuex'

// import category index
import categories from './modules/category'
// import brand index
import brands from './modules/brand'
// import size index
import sizes from './modules/size'

const store = createStore({
   modules: {
     categories,
     brands,
     sizes
    }
})

export default store