<template>
    <form @submit.prevent="submitForm" method="POST">
        <div class="row">
        <show-error></show-error>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Return product</h5> <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Products<span class="text-danger">*</span></label>
                                <select @change="selectedProduct(form.product_id)" class="form-control" v-model="form.product_id">
                                    <option value="">Select prodyct</option>
                                    <option v-for="(product, index) in products" :key="index"
                                        v-bind:value="product.id">
                                        {{ product.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" v-model="form.date">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- card for size -->
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Product size</h5> <br>
                        <table class="table table-sm">
                            <tr v-for="(item, index) in form.items" :key="index">
                                <td>{{ item.size.size }}</td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.quantity" placeholder="Quantity">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
    </form>
</template>

<script>
import * as actions from '../../store/action-types'
import store from '../../store'
import {mapGetters} from 'vuex'
import ShowError from '../utils/ShowError.vue'

export default {
    components: {
        ShowError
    },

    data() {
        return {
            form: {
                date: '',
                product_id: '',
                items: [
                   
                ]
            },
            errors: []
        }
    },

    computed: {
        // covert state category into vue property
        ...mapGetters({
            'products': 'getProducts'
        })
    },

    mounted() {
        // Call action  for get products
        store.dispatch(actions.GET_PRODUCT)
    },

    methods: {
       selectedProduct(id) {
            this.form.items = []
            let product = this.products.filter((product) => {
                return product.id == id
            })

            product[0].product_stock.map((stock) => {
                let item = {
                    size: stock.size,
                    size_id: stock.size_id,
                    quantity: ''
                }
                this.form.items.push(item)
            })
       },
       submitForm() {
            store.dispatch(actions.SUBMIT_RETURN_PRODUCT, this.form)
       }
    }

}
</script>

<style>
    
</style>