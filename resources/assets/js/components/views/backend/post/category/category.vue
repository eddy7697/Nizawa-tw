<template>
    <div class="row">
        <div class="col-md-12" style="width: 100%">
            <categoryTree 
                :type="'post'"
            />
        </div>
    </div>
</template>

<script>
    var categoryTree = require('../../../../common/categoryTree.vue');

    export default {
        components: {
            categoryTree
        },
        data() {
            return {
            }
        },
        created: function () {
        },
        computed: {
        },
        methods: {
        }
    }
</script>
