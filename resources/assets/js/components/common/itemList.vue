<template>
    <div class="row">
        <div class="col-md-12">
            <table class="table field-table">
                <thead>
                    <tr>
                        <th v-if="config.checkBox" width="30" @click="toggleAllSelected()">
                            <input type="checkbox" v-model="isAllSelected">
                        </th>
                        <th 
                            v-for="item in column" 
                            v-bind:key="item.id" 
                            @click="sort(item)"
                            v-bind:class="{'align-center' : item.alignment == 'center', 'align-left' : item.alignment == 'left', 'align-right' : item.alignment == 'right', 'pointer' : item.sortable}">
                            {{ item.label }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td v-if="config.checkBox">
                            <input type="checkbox" v-model="item.isSelect">
                        </td>
                        <td 
                            v-for="(col, index) in column" 
                            :key="index" 
                            @click="rowFunction(col, item)"
                            v-bind:class="{'align-center' : col.alignment == 'center', 'align-left' : col.alignment == 'left', 'align-right' : col.alignment == 'right'}">    
                            <span v-if="col.formatter" v-html="col.formatter(item)"></span>   
                            <span v-else>{{item[col.id]}}</span>                     
                            
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td v-if="config.checkBox" @click="toggleAllSelected()">
                            <input type="checkbox" v-model="isAllSelected">
                        </td>
                        <td v-bind:colspan="column.length">
                            <table>
                                <tr>
                                    <td>
                                        <select class="form-control" v-model="listFunction" style="width:120px">
                                            <option v-for="(item, index) in config.listFunction" v-bind:key="index" v-bind:value="item.method">{{item.title}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" @click="doListFunction()">執行</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'config',
            'column',
            'data',
            'selectedItem'
        ],
        data() {
            return {
                allSelect: false,
                listFunction: 'default'
            }
        },
        created() {
            // console.log(this.column)
            // console.log(this.data)
            // console.log(this.config)
            // console.log(_)
        },
        watch: {
            // isAllSelected: {
            //     handler (isAllSelected, oldVal) {
            //         this.allSelect = isAllSelected
            //     }
            // },
            // allSelect: {
            //     handler (allSelect, oldVal) {
            //         this.toggleAllSelected()
            //     }
            // }
        },
        computed: {
            isAllSelected () {
                let dataProp = this.data.map(item => {
                    return item.isSelect
                })

                return !_.includes(dataProp, false)               
            }
        },
        methods: {
            toggleAllSelected () {
                var self = this
                if (this.isAllSelected) {
                    this.data.forEach(item => {
                        item.isSelect = false
                    })
                } else {
                    this.data.forEach(item => {
                        item.isSelect = true
                    })
                }
            },
            rowFunction (col, item) {
                if (col.type === 'method') {
                    this.$emit(col.method, item)
                }                
            },
            doListFunction () {
                var items;

                items = this.data.map(elm => {
                    if (elm.isSelect) {
                        return elm
                    }
                })

                this.$emit('doListFunction', {
                    method: this.listFunction,
                    content: _.compact(items)
                })
            },
            sort (item) {
                this.$emit('sortAction', item.id)
            }
        }
    }
</script>
