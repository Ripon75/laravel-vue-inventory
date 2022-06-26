import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios from 'axios'

export default {
    [actions.ADD_PRODUCT]({commit}, payload) {
        axios.post('/products', payload)
        .then((response) => {
            if (response.data.success) {
                window.location = '/products'
            }
        })
        .catch((error) => {
            commit(mutations.SET_ERRORS, error.response.data.errors)
        });
    },

    [actions.EDIT_PRODUCT]({commit}, payload) {
        axios.post(`/products/${payload.id}`, payload.data)
        .then((response) => {
            if (response.data.success) {
                window.location = '/products'
            }
        })
        .catch((error) => {
            commit(mutations.SET_ERRORS, error.response.data.errors)
        });
    },

    [actions.GET_PRODUCT]({commit}) {
        axios.get('/api/products')
        .then((response) => {
                if (response.data.success) {
                    commit(mutations.SET_PRODUCTS, response.data.data)
                }
        })
        .catch((error) => {
            console.log(error)
        })
    }
}