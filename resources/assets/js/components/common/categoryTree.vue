<template>
    <div class="row">
        <div class="col-md-6">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#category-list">類別列表</a></li>
                <li class="pull-right">
                    <button class="btn btn-default" v-bind:disabled="deleteDisable" @click="deleteCategory()">刪除類別</button>
                </li>
                <li class="pull-right">
                    <button class="btn btn-default" v-bind:disabled="editDisable" @click="openEditModal(true)">編輯類別</button>
                </li>
                <li class="pull-right">
                    <button class="btn btn-default" v-bind:disabled="addDisabled" @click="openEditModal(false)">新增類別</button>
                </li>
            </ul>
            <!-- <div v-if="categories.length === 0" class="alert alert-info" role="alert">
                目前沒有類別，趕快去新增一個吧!
            </div> -->
            <div id="tree" class="cms-tree" ref="treeContent">
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">編輯類別</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        類別名稱
                                    </label>
                                    <input type="text" class="form-control" ref="categoryInput" v-model="editCategoryForm.categoryName"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="editCategory()">儲存類別</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import Ckeditor from 'vue-ckeditor2';
    var Tree = require('../lib/treeConverter.js', ).default;

    Vue.use(Tree)
    export default {
        props: [
            'type',
        ],
        components: {
            Ckeditor
        },
        data() {
            return {
                editCategoryForm: {
                    guid: null,
                    categoryName: null,
                    categoryParent: null,
                    type: null,
                    description: null,
                    featureImage: null
                },
                ckConfig: {
                    height: 300,
                    allowedContent: true,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
                },
                dragEnter: false,
                activatedNode: null,
                categories: [],
                editMode: false,
                token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        created: function () {
            var self = this
            this.getCategories(this.type);

            $(window).resize(arg => {
                self.updateLayout()
            })
            
            $('.loading-bar').fadeOut('100');
        },
        computed: {
            addDisabled() {
                var tree = $('#tree').fancytree;

                if (this.activatedNode == 'ALL') {
                    return false
                } else {
                    try {
                        if ($('#tree').fancytree('getActiveNode').getLevel() > 3) {
                            return true
                        } else {
                            return false
                        }
                    } catch (error) {
                        return true
                    }
                    
                }
            },
            editDisable() {
                if (this.activatedNode == 'ALL') {
                    return true
                } else {
                    return false
                }
            },
            deleteDisable() {
                if (this.activatedNode == 'ALL') {
                    return true
                } else {
                    return false
                }
            }
        },
        methods: {
            editImage: function () {
                var self = this;

                window.open('/laravel-filemanager' + '?type=Images', 'FileManager', 'width=1280,height=1024');
                window.SetUrl = function (url, file_path) {
                    self.editCategoryForm.featureImage = file_path;
                };
            },
            editCategory: function () {
                var self = this
                var token = this.token
                var item = this.editCategoryForm

                if (this.editMode) {
                    var vo = {
                        category: item.guid,
                        name: item.categoryName,
                        type: this.type,
                        parentId: item.categoryParent,
                        description: item.description
                    }
                } else {
                    var vo = {
                        name: item.categoryName,
                        type: this.type,
                        parentId: this.activatedNode == 'ALL' ? null : this.activatedNode,
                        description: item.description
                    }
                }

                if (item.categoryName.trim() === '') {
                    this.showMessage('warning', '欄位名稱不可為空白');
                    return;
                }

                $('.loading-bar').fadeIn('100');

                $.ajax({
                    url: self.editMode ? '/admin/category/update' : '/admin/category/add',
                    type: 'POST',
                    dataType: 'json',
                    data: vo,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.getCategories(self.type);
                    self.showMessage('success', '類別編輯成功');
                    $('#myModal').modal('hide');
                })
                .fail(function(errorData) {
                })
                .always(function() {
                    $('.edit-category-input').blur();
                    $('.loading-bar').fadeOut('100');
                });

            },
            deleteCategory: function () {
                var self = this;
                var token = this.token;                
                var node = $('#tree').fancytree('getActiveNode')

                if (node.hasChildren()) {
                    this.showMessage('warning', '該類別下層仍有子類別，無法刪除')
                    return                    
                }

                var checkProperty = confirm("是否刪除類別?");

                if (checkProperty) {
                    $.ajax({
                        url: '/admin/category/delete',
                        type: 'POST',
                        dataType: 'json',
                        data: {category: self.activatedNode},
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    })
                    .done(function(result) {
                        self.activatedNode = 'ALL'

                        self.showMessage('success', result.message)
                    })
                    .fail(function(errorData) {
                        self.showMessage('error', errorData.responseJSON.message);
                    })
                    .always(function() {
                        self.getCategories(self.type);
                    });
                }


            },
            openEditModal: function (mode) {
                var node = $('#tree').fancytree('getActiveNode')

                this.editMode = mode;

                this.editCategoryForm.categoryName = mode ? node.data.name : null;
                this.editCategoryForm.categoryParent = mode ? node.data.parentId : null;
                // this.editCategoryForm.description = item.description;
                this.editCategoryForm.guid = mode ? node.key : null;

                $('#myModal').modal({backdrop: 'static', keyboard: false});
                this.$nextTick(() => {
                    $(this.$refs.categoryInput).focus()
                })
            },
            getCategories: function (type) {
                var self = this;
                var token = this.token;

                $.ajax({
                    url: '/admin/category/get',
                    type: 'POST',
                    cache: false,
                    data: {
                        type: type
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                    self.categories = [];
                    result.forEach(function(item) {
                        self.categories.push({
                            'categoryParent': item.parentId,
                            'name': item.categoryTitle,
                            'guid': item.categoryGuid,
                            'parentId': item.parentId,
                            'isEdit': false,
                            'description': item.categoryDescription,
                            'featureImage': item.featureImage
                        });
                    });
                    self.updateLayout()
                    self.generateTree(Tree.convert(self.categories))
                })
                .fail(function() {
                })
                .always(function() {
                });

            },
            orderTree(nodeMap) {
                var self = this;
                var token = this.token;
                
                $('.loading-bar').fadeIn('100');                

                $.ajax({
                    url: '/admin/category/order',
                    type: 'POST',
                    cache: false,
                    data: {
                        order: nodeMap
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                })
                .fail(function() {
                })
                .always(function() {                    
                    setTimeout(() => {
                        self.getCategories(self.type)
                        $('.loading-bar').fadeOut('100');
                    }, 200)                   
                });
            },
            moveCategory(category, parent, nodeMap) {
                var self = this;
                var token = this.token;
                
                $('.loading-bar').fadeIn('100');                

                $.ajax({
                    url: '/admin/category/move',
                    type: 'POST',
                    cache: false,
                    data: {
                        category: category,
                        parent: parent,
                        nodeMap: nodeMap
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                })
                .done(function(result) {
                })
                .fail(function() {
                })
                .always(function() {                    
                    setTimeout(() => {
                        self.getCategories(self.type)
                        $('.loading-bar').fadeOut('100');
                    }, 200)
                });
            },
            generateTree(data) {
                var self = this
                
                try {
                    var tree = $('#tree').fancytree("getTree")

                    if (tree) {
                        tree.reload(data)
                        if (this.activatedNode) {
                            $('#tree').fancytree("getTree").activateKey(this.activatedNode)
                        } else {
                            this.activatedNode = $('#tree').fancytree("getActiveNode").key
                        }
                        return
                    }
                } catch (error) {
                    
                }

                $("#tree").fancytree({
                    checkbox: false,
                    extensions: ["dnd5"],
                    source: data,
                    icon: true,
                    click: (event, data) => {
                    },
                    activate: (event, data) => {
                        self.activatedNode = data.node.key
                    },
                    dnd5: {
                        autoExpandMS: 400,
                        focusOnClick: true,
                        preventVoidMoves: true,
                        preventRecursiveMoves: true,
                        dropMarkerInsertOffsetX: -10,
                        dragStart: function(node, data) {
                            if (node.key == 'KEY') {
                                return false
                            } else {
                                return true
                            }
                        },
                        dragEnter: function(node, data) {
                            return true
                        },
                        dragOver: (node, data) => {
                            var origin = data.otherNode
                            var target = node
                            var originLevel = origin.getLevel() - 1 + (origin.getLevel() == 2) ? (origin.hasChildren() ? 1 : 0) : (origin.hasChildren() ? 1 : -1)
                            var targetLevel = target.getLevel() - 1 + (target.hasChildren() ? 1 : 0)
                            
                            if (data.hitMode == 'over') {
                                if (origin.parent.key == target.key) {
                                    self.dragEnter = false
                                    return self.dragEnter
                                }
                                if ((originLevel + targetLevel) > 1) {
                                    if (targetLevel > 1) {
                                        self.dragEnter = false
                                        return self.dragEnter
                                    }
                                    if (!origin.hasChildren()) {
                                        self.dragEnter = true
                                        return self.dragEnter
                                    } else {
                                        self.dragEnter = false
                                        return self.dragEnter
                                    }
                                } else {
                                    self.dragEnter = true
                                    return self.dragEnter
                                }
                                
                            } else {                                
                                if (target.key == 'ALL') {
                                    self.dragEnter = false
                                    return self.dragEnter
                                }
                                if (origin.hasChildren() && targetLevel > 1 && target.getLevel() > 2) {
                                    self.dragEnter = false
                                    return self.dragEnter
                                }
                                self.dragEnter = true
                                return self.dragEnter
                            }                                                          
                        },
                        dragDrop: function(node, data) {
                            if (!self.dragEnter) {
                                return
                            }    
                            
                            data.otherNode.moveTo(node, data.hitMode);

                            var allNodes = $('#tree').fancytree('getTree').findAll('')
                            var nodeMap
                            var parent
                                
                            nodeMap = _.compact(allNodes.map((elm, index) => {
                                if (elm.key !== 'ALL') {
                                    return {
                                        index: index,
                                        guid: elm.key
                                    }
                                }
                            }))

                            if (data.hitMode == 'over') {
                                parent = data.node.key
                            } else {
                                parent = node.parent.key
                            }
                            
                            self.moveCategory(data.otherNode.key, parent, nodeMap)
                        }
                    },
                })

                if (!$(".fancytree-container").hasClass("fancytree-connectors")) {
                    $(".fancytree-container").addClass("fancytree-connectors")
                }

                if (this.activatedNode) {
                    $('#tree').fancytree("getTree").activateKey(this.activatedNode)
                } else {
                    this.activatedNode = $('#tree').fancytree("getActiveNode").key
                }
            },
            updateLayout() {
                var treeContent = $(this.$refs.treeContent)
                var windowHeight = $(window).height()
                var checkContainerExist = setInterval(check, 10)

                function check() {
                    if (treeContent.find('ul.fancytree-container').length ? true : false) {
                        treeContent.find('ul.fancytree-container').css({
                            'max-height': windowHeight - treeContent.offset().top - 100,
                            'overflow': 'auto'
                        })
                        clearInterval(checkContainerExist)
                        
                    }
                }                
            },
            showMessage: function (type, string) {
                toastr[type](string);
            }
        }
    }
</script>
