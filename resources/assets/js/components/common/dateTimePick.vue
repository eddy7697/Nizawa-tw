<template>
    <div class="block">
        <el-date-picker
            v-model="schedulePost"
            type="datetime"
            placeholder="選擇商品上架時間">
        </el-date-picker>
    </div>
</template>

<script>
    // import ElementUI from 'element-ui'
    // import 'element-ui/lib/theme-chalk/index.css'
    // import lang from 'element-ui/lib/locale/lang/zh-TW'
    // import locale from 'element-ui/lib/locale'

    // Vue.use(ElementUI);
    // locale.use(lang)

    export default {
        mounted () {
            console.log('Component mounted.')
        },
        data () {
            return {
                schedulePost: null
            }
        },
        methods: {
        }
    }
</script>
