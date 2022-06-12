import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios  from 'axios'

export default {
    [actions.GET_BRANDS]({commit}) {
        axios.get('/api/brands')
        .then((response) => {
                if (response.data.success) {
                    commit(mutations.SET_BRANDS, response.data.data)
                }
        })
        .catch((error) => {
            console.log(error)
        })
    }
}