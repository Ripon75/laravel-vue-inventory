<template>
    <div class="col-sm-12" v-if="isError">
        <div class="alert alert-danger">
            <ul>
                <li v-for="(error, index) in errors" :key="index">
                    {{ error[0] }}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    name: 'ShowError',
    computed: {
        ...mapGetters({ 
            isError: 'getIsErrors',
            errors: 'getErrors'
        })
    }
}
</script>
<style>
    
</style>