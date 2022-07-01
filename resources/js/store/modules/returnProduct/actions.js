import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios from 'axios'

export default {
    [actions.SUBMIT_RETURN_PRODUCT]({commit}, payload) {
        axios.post('/return-products', payload)
        .then((response) => {
            if (response.data.success) {
                window.location.href = '/return-products'
            }
        })
        .catch((error) => {
            commit(mutations.SET_ERRORS, error.response.data.errors)
        });
    }
}