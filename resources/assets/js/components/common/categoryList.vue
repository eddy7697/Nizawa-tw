<template>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." v-model="selectedCategoryName" readonly @click="openModal()">
                <span class="input-group-btn">
                    <button class="btn btn-default" @click="openModal()">{{btnTitle}}</button>
                </span>
            </div>
            <div class="modal fade" ref="category" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            選擇類別
                        </div>
                        <div class="modal-body">
                            <div ref="categoryTree" id="categoryTree" class="cms-tree"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" @click="selectCategory()">
                                確定
                            </button>
                            <button class="btn btn-default" @click="closeModal()">
                                取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var Tree = require('../lib/treeConverter.js', ).default;

    export default {
        mounted () {      
            $(this.$refs.category).on('show.bs.modal', e => {                
                this.generateTree()
            })
            $(this.$refs.category).on('hidden.bs.modal', e => {
            })
        },
        props: [
            'btnTitle',
            'data',
            'selectedCategoryName',
            'selectedCategoryKey'
        ],
        created() {
            // this.generateTree()
        },
        data () {
            return {

            }
        },
        computed: {
            content () {
                // return "全部類別"
            },
            treeData () {
                return Tree.convert(this.data)
            }
        },
        watch: {
        },
        methods: {
            openModal () {
                $(this.$refs.category).modal({backdrop: 'static', keyboard: false})
            },
            generateTree () {
                var self = this

                $(this.$refs.categoryTree).fancytree({
                    checkbox: false,
                    source: self.treeData,
                    icon: false,
                    lazyLoad: () => {
                        
                    }
                })

                if (!$(".fancytree-container").hasClass("fancytree-connectors")) {
                    $(".fancytree-container").addClass("fancytree-connectors")
                }

                $(self.$refs.categoryTree).find('ul.fancytree-container').css({
                    'max-height': '600px',
                    'overflow': 'auto'
                })
            },
            selectCategory () {
                var node = $(this.$refs.categoryTree).fancytree("getActiveNode")
                
                this.$emit('changeCategory', node.key)
                $(this.$refs.category).modal('hide')
            },
            closeModal () {
                $(this.$refs.category).modal('hide')
            }
        }
    }
</script>

