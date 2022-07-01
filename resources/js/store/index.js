import {createStore} from 'vuex'

// import errors index
import errors from './modules/utils/errors'
// import category index
import categories from './modules/category'
// import brand index
import brands from './modules/brand'
// import size index
import sizes from './modules/size'
// import product index
import products from './modules/product'
// import stock index
import stocks from './modules/stock'
// import return product index
import returnProducts from './modules/returnProduct'

const store = createStore({
   modules: {
     errors,
     categories,
     brands,
     sizes,
     products,
     stocks,
     returnProducts
    }
})

export default store