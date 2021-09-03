<template>

    <div>

        <u-spinner v-if="loading"></u-spinner>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Photo</th>
                <th scope="col">Date</th>
                <th scope="col" v-if="auth">Create New :
                    <button @click.prevent="create" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <th scope="row">{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.year }}</td>
                <td><img :src="product.photo" alt="" width="32"></td>
                <td>{{ product.created_at }}</td>
                <td v-if="auth">
                    <button @click.prevent="edit(product)" type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
                    <button @click.prevent="destroy(product.id)" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            </tbody>
        </table>


        <!-- MODAL -->
        <div v-if="showModal && auth">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" @click="showModal = false">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p v-show="this.errors">
                                        <small class="text-danger">{{ this.errors }}</small>
                                    </p>

                                    <ValidationObserver v-slot="{ invalid }">
                                        <form @submit.prevent="submitModal">
                                            <u-spinner v-if="loading"></u-spinner>

                                            <ValidationProvider rules="required" v-slot="v">
                                                <div class="mb-3">
                                                    <label for="nameID" class="form-label">Name</label>
                                                    <input v-model="selected.name" type="text" class="form-control" id="nameID">
                                                    <small class="text-danger">{{ v.errors[0] }}</small>
                                                </div>
                                            </ValidationProvider>


                                            <ValidationProvider rules="required|integer" v-slot="v">
                                                <div class="mb-3">
                                                    <label for="yearID" class="form-label">Year</label>
                                                    <input v-model="selected.year" type="text" class="form-control" id="yearID">
                                                    <small class="text-danger">{{ v.errors[0] }}</small>
                                                </div>
                                            </ValidationProvider>

                                            <ValidationProvider rules="required" v-slot="v">
                                                <div class="mb-3">
                                                    <label for="photoID" class="form-label">Photo</label>
                                                    <input v-model="selected.photo" type="text" class="form-control" id="photoID">
                                                    <small class="text-danger">{{ v.errors[0] }}</small>
                                                </div>
                                            </ValidationProvider>


                                            <ValidationProvider rules="required" v-slot="v">
                                                <div class="mb-3">
                                                    <label for="dateID" class="form-label">Date</label>
                                                    <input v-model="selected.created_at" type="text" class="form-control" id="dateID" data-provide="datepicker">
                                                    <small class="text-danger">{{ v.errors[0] }}</small>
                                                </div>
                                            </ValidationProvider>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                                <button type="submit" class="btn btn-primary" :disabled="invalid">Submit</button>
                                            </div>
                                        </form>
                                    </ValidationObserver>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>


    </div>


</template>

<script>
// Vee Validate
import {ValidationProvider, ValidationObserver, extend} from 'vee-validate';
import {required, integer} from 'vee-validate/dist/rules';

extend('integer', integer);
extend('required', {...required, message: 'This field is required'});

export default {
    name      : "u-table",
    props     : ['auth'],
    components: {
        ValidationProvider,
        ValidationObserver
    },
    data() {
        return {
            showModal: false,
            loading  : false,
            creating : false,
            products : [],
            selected : {},
            errors   : null
        }
    },
    methods: {
        async all() {
            this.loading = true
            const {data} = await http.get('/api/products')
            this.products = data.data
            this.loading = false
        },
        create() {
            this.showModal = true
            this.creating = true
            this.selected = {}
        },
        edit(product) {
            this.showModal = true
            this.selected = product
        },
        destroy(id) {
            this.loading = true
            http.delete(`/api/products/${id}`).then(async () => {
                await this.all()
                this.loading = false
            })
        },
        async submitModal() {
            if (this.creating) {
                await http.post('/api/products/', this.selected).catch((error) => this.errors = error.response.data.message)
            } else {
                await http.put('/api/products/', this.selected).catch((error) => this.errors = error.response.data.message)
            }

            this.showModal = _.size(this.errors) > 0;
            await this.all()
        },
    },
    mounted() {
        this.all()
    }
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
</style>
