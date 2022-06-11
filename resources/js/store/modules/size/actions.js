import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import axios  from 'axios'

export default {
    [actions.GET_SIZES]({commit}) {
        axios.get('/api/sizes')
        .then((response) => {
                if (response.data.success) {
                    commit(mutations.SET_SIZES, response.data.data)
                }
        })
        .catch((error) => {
            console.log(error)
        })
    }
}