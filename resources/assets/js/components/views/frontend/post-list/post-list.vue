
<template>
	<section>
		<div class="container new-list">
			<div class="row">
				<div class="col-md-7 mx-auto news-search-form">
					<form v-on:submit.prevent="searchPost">
						<div class="input-group mb-3">
							<input type="text" class="form-control search-input shadow-none" v-model="keyword" :placeholder="i18n.search_placeholder">
							<div class="input-group-append">
								<button class="btn btn-search" type="submit">{{i18n.search}}</button> 
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-md-12 news-list-category">
					<button class="btn site-btn" @click="selectedCategory = null" :class="{active: selectedCategory == null}">{{i18n.all_news}}</button>
					<button class="btn site-btn" 
						v-for="(item, index) in categoryList.data" 
						@click="selectedCategory = item.categoryGuid"
						:class="{active: selectedCategory == item.categoryGuid}"
						:key="index">{{parseTitle(item.categoryTitle)}}</button>
				</div>

				<div class="col-md-12">
					<div class="card-columns">
						<a :href="`/blog/${item.customPath}`" v-for="(item, index) in pageData.data" :key="index">
							<div class="card">
								<div class="featureImage" :style="`background-image: url('${item.featureImage}');`" />
								<!-- <img class="card-img-top" :src="item.featureImage" :alt="item.postTitle"> -->
								<div class="card-body">
									<h4 class="card-title">{{item.postTitle}}</h4>
									<p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;{{item.created_at}}</p>
									<div class="card-info">
										<p class="card-text" v-html="pregReplace(item.content)"></p>
									</div>
								</div>
							</div>
						</a>   
					</div>
				</div>
				<div class="col-md-12 btn-section" v-if="pageLoaded">
					<div v-if="pageData.current_page == pageData.last_page" class="scrolldown-endpoint">
						<img src="/img/findmore.png" alt="">
						<h4>{{i18n.post_out}}</h4>
						<p v-html="i18n.post_find_contact"></p>
					</div>
					<img v-if="isLoadingLearnMore" width="50" src="/img/icon/loading-spinner.svg">
				</div>
			</div>
		</div>
	</section>
</template>

<script>
    export default {
        mounted () {
        },
		props: ['locale'],
        data () {
			let i18n = JSON.parse(document.getElementById('i18n-text').value)
            return {
				i18n: i18n,
				pageLoaded: false,
				isLoading: false,
				isLoadingLearnMore: false,
				categoryList: [],
				selectedCategory: null,
				pageData: {},
				keyword: null,
				urlPath: `/posts`,
				actionLock: false
            }
		},
		created() {
			this.getData()
			this.getCategories()
		},
		watch: {
			urlPath() {
				this.getData()
			},
			selectedCategory() {
				this.pageLoaded = false
				this.getData()
			}
		},
        methods: {
			getCategories() {
				axios.get(`/posts/category`)
					.then(res => {
						this.categoryList = res.data
					})
			},
			getData() {
				if (!this.pageLoaded) {
					let vo = {
						cate: this.selectedCategory,
						keyword: this.keyword
					}

					$('.loading-bar').show()

					axios.post(this.urlPath, vo)
						.then(res => {
							this.pageData = res.data
							this.pageLoaded = true
							$('.loading-bar').hide()
							this.scrollMore()
						})
				}				
			},
			searchPost() {
				this.pageLoaded = false
				this.getData()
			},
			dateFormat(date) {
                return moment(date).format('YYYY/MM/DD')
			},
			pregReplace(text) {
				return mb_strimwidth(text.replace(/<[^>]+>/g, '').replace(/&nbsp;/g, ""), 0, 200, "...");
			},
			learnMoreAction() {
				let self = this
                this.isLoading = true
                this.isLoadingLearnMore = true
				
				if (!this.actionLock) {
					this.actionLock = true
					axios.post(this.pageData.next_page_url)
						.then(res => {
							this.pageData.next_page_url = res.data.next_page_url
							this.pageData.current_page = res.data.current_page
							res.data.data.forEach(elm => {
								this.pageData.data.push(elm)
							});
						}).catch(err => {
							console.log(err)
							// this.$message.error('出現不明錯誤，請聯繫管理員')
						}).then(() => {
							this.actionLock = false
							this.isLoading = false
							this.isLoadingLearnMore = false
						})
				}
                
			},
			parseTitle(title) {
				return JSON.parse(title)[this.locale]
			},
			scrollMore(){
                let timer;
                $(document).scroll(() => {
                    window.clearTimeout(timer);

                    timer = window.setTimeout(()=> {
                        let docH = $(document).height();
                        let scrollH = $(document).scrollTop() + ($('.site-footer').height()/2) + window.innerHeight;
                        if (scrollH > docH) {
                            this.learnMoreAction();
                        }
                    }, 100);
                   
                });
            },
        }
    }
</script>

<style lang="scss">
</style>
