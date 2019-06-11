<template>
    <div>

        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm">
                <li class="page-item" :class="!hasPreviousPage() ? 'disabled' : ''" @click="prevPage()"><a
                        class="page-link" href="#">Previous</a></li>
                <li class="page-item" v-if="displayPageNumber(page)" @click="loadPage(page)"
                    :class="getActiveClass(page)" v-for="page in data.last_page"><a class="page-link"
                                                                                    href="#">{{page}}</a></li>
                <li class="page-item" :class="!hasNextPage() ? 'disabled' : ''" @click="nextPage()"><a class="page-link"
                                                                                                       href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: {
            data: {},
            event: {}
        },
        data() {
            return {}
        },
        methods: {
            hasPreviousPage() {
                return this.data.prev_page_url;
            },
            hasNextPage() {
                return this.data.next_page_url;
            },
            getActiveClass(page) {
                return page === this.data.current_page ? 'active' : '';
            },
            loadPage(page) {
                Bus.$emit('loadJobs', page);
            },
            prevPage() {
                if (this.hasPreviousPage()) {
                    Bus.$emit('loadJobs', this.data.current_page - 1);
                }
            },
            nextPage() {
                if (this.hasNextPage()) {
                    Bus.$emit('loadJobs', this.data.current_page + 1);
                }
            },
            displayPageNumber(page) {
                let current = this.data.current_page;

                if (current === page) {
                    return true;
                }

                var min = current - 4;
                var max = current + 4;

                if (page > min && page < max) {
                    return true;
                }

                if(page === 1){
                    return true;
                }

                if(page === this.data.last_page){
                    return true;
                }

            }
        }
    }
</script>