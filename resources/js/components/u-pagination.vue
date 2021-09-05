<template>
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item " :class="{ 'disabled': !link.url,'active': link.active }" v-for="link in data.links">
                <a class="page-link" href="" v-html="link.label" @click.prevent="page(link)"></a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name : "u-pagination",
    props: ['data'],
    event: ['pageChange'],
    methods:{
        page(link){
            this.$emit('pageChange',link)
            // this.$forceUpdate()
        }
    }
}
</script>
