<template>

    <div>

        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border" role="status"></div>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Photo</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <th scope="row">{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.year }}</td>
                <td><img :src="product.photo" alt="" width="32"></td>
                <td>{{ product.created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>


</template>

<script>
export default {
    name : "u-table",
    props: {auth: Boolean},
    data() {
        return {
            loading : false,
            products: []
        }
    },
    methods: {
        async all() {
            this.loading = true
            const {data} = await http.get('/api/products')
            this.products = data.data
            this.loading = false
        }
    },
    mounted() {
        this.all()
    }
}
</script>

