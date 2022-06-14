<template>
    <form @submit.prevent="submitForm" method="POST">
        <div class="row">
        <show-error></show-error>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Product Create</h5> <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Product name <span class="text-danger">*</span></label>
                                <input v-model="form.name" type="text" class="form-control"
                                    placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="">Product category <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.category_id">
                                    <option value="">Select category</option>
                                    <option v-for="(category, index) in categories" :key="index"
                                        v-bind:value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product brand <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.brand_id">
                                    <option value="">Select brand</option>
                                    <option v-for="brand in brands" :key="brand.id" v-bind:value="brand.id">
                                        {{ brand.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product SKU <span class="text-danger">*</span></label>
                                <input v-model="form.sku" type="text" class="form-control"
                                    placeholder="Enter product sku">
                            </div>
                            <div class="form-group">
                                <label for="">Product image</label>
                                <input @change="selectImage" type="file" class="form-control" placeholder="Enter product image">
                            </div>
                            <div class="form-group">
                                <label for="">Product cost price </label>
                                <input v-model="form.cost_price" type="number" class="form-control"
                                    placeholder="Enter cost price">
                            </div>
                            <div class="form-group">
                                <label for="">Product retail price </label>
                                <input v-model="form.retail_price" type="number" class="form-control"
                                    placeholder="Enter retail price">
                            </div>
                            <div class="form-group">
                                <label for="">Product status <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.status">
                                    <option value="1">Active</option>
                                    <option value="0">Inctive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product year </label>
                                <input v-model="form.year" type="number" class="form-control" placeholder="Enter year Ex: 2022">
                            </div>
                            <div class="form-group">
                                <label for="">Product description</label>
                                <input v-model="form.description" type="text" class="form-control"
                                    placeholder="Enter description">
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
                        <div class="card-body">
                            <div class="row mb-1" v-for="(item, index) in form.items" :key="index">
                                <div class="col-md-4">
                                    <select class="form-control" v-model="item.size_id">
                                        <option value="">Select size</option>
                                        <option v-for="size in sizes" :key="size.id" :value="size.id">{{ size.size }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" v-model="item.location" class="form-control"
                                        placeholder="Location">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" v-model="item.quantity" class="form-control"
                                        placeholder="Quantity">
                                </div>
                                <div class="col-md-2">
                                    <button @click="deleteItem(index)" type="button" class="btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button @click="addItem" type="button" class="btn btn-primary btn-sm mt-2">
                                <f class="fa fa-plus"></f>Add item
                            </button>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        </div>
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
                category_id: '',
                brand_id: '',
                name: '',
                sku: '',
                image: '',
                cost_price: 0,
                retail_price: 0,
                year: '',
                description: '',
                status: 1,
                items: [
                    {
                        size_id: '',
                        location: '',
                        quantity: 0
                    }
                ]
            },
            errors: []
        }
    },

    computed: {
        // covert state category into vue property
        ...mapGetters({
            'categories': 'getCategories',
            'brands': 'getBrands',
            'sizes': 'getSizes',
        })
    },

    mounted() {
        // Call action  for get categories
        store.dispatch(actions.GET_CATEGORIES)
        // Get brands
        store.dispatch(actions.GET_BRANDS)
        // Get sizes
        store.dispatch(actions.GET_SIZES)
    },

    methods: {
        // for image
        selectImage(e) {
            this.form.image = e.target.files[0]
        },
        // Add item
        addItem() {
            let item = {
                size_id: '',
                location: '',
                quantity: 0
            }
            this.form.items.push(item)
        },

        // Delete item
        deleteItem(index) {
            this.form.items.splice(index, 1)
        },

        // form submit
        submitForm() {
            let formData = new FormData()
            formData.append('category_id', this.form.category_id)
            formData.append('brand_id', this.form.brand_id)
            formData.append('name', this.form.name)
            formData.append('sku', this.form.sku)
            formData.append('image', this.form.image)
            formData.append('cost_price', this.form.cost_price)
            formData.append('retail_price', this.form.retail_price)
            formData.append('year', this.form.year)
            formData.append('description', this.form.description)
            formData.append('status', this.form.status)
            formData.append('items', JSON.stringify(this.form.items))

            store.dispatch(actions.ADD_PRODUCT, formData)
        }
    },

}
</script>

<style>
    
</style>