import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios  from 'axios'

export default {
    [actions.GET_CATEGORIES]({commit}) {
        axios.get('/api/categories')
        .then((response) => {
                if (response.data.success) {
                    commit(mutations.SET_CATEGORIES, response.data.data)
                }
        })
        .catch((error) => {
            console.log(error)
        })
    }
}