<template>
    <div class="row">
        <div class="col-md-12">
            <form v-on:submit.prevent="searchPost">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for..." v-model="content">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">{{btnTitle}}</button>
                  </span>
                </div><!-- /input-group -->
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted () {
            console.log('Component mounted.')
        },
        props: [
          'btnTitle',
          'keyword'
        ],
        data () {
            return {
              content: this.keyword
            }
        },
        watch: {
          content: {
            handler (content, oldVal) {
              this.$emit('newKeyword', content)
            }
          }
        },
        methods: {
          searchPost() {
            this.$emit('searchPost', 123)
          }
        }
    }
</script>
