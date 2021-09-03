<template>

    <!--  TODO//    -->


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

                                <form @submit.prevent="submitModal">
                                    <u-spinner v-if="loading"></u-spinner>


                                    <div class="mb-3">
                                        <label for="nameID" class="form-label">Name</label>
                                        <input v-model="selected.name" type="text" class="form-control" id="nameID">
                                    </div>

                                    <div class="mb-3">
                                        <label for="yearID" class="form-label">Year</label>
                                        <input v-model="selected.year" type="text" class="form-control" id="yearID">
                                    </div>

                                    <div class="mb-3">
                                        <label for="photoID" class="form-label">Photo</label>
                                        <input v-model="selected.photo" type="text" class="form-control" id="photoID">
                                    </div>


                                    <div class="mb-3">
                                        <label for="dateID" class="form-label">Date</label>
                                        <input v-model="selected.created_at" type="text" class="form-control" id="dateID" data-provide="datepicker">
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name : "u-modal",
    props: {
        showModal: Boolean,
        auth     : Number,
        loading  : Boolean,
    },
    data() {
        return {
            selected: {
                name      : '',
                year      : '',
                photo     : '',
                created_at: '',
            }
        }
    },
    methods: {
        submitModal() {
            this.$emit('submitModal')
        }
    }
}
</script>

