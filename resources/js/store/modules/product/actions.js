import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios from 'axios'

export default {
    [actions.ADD_PRODUCT]({commit}, payload) {
        axios.post('/products', payload)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            commit(mutations.SET_ERRORS, error.response.data.errors)
        });
    }
}