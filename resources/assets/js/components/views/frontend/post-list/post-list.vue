
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
						<a :href="`/blog/${item.id}`" v-for="(item, index) in pageData.data" :key="index">
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
				<div class="col-md-12 force-center" style="margin-top: 30px">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item" v-if="pageData.current_page !== 1"><a class="option page-link hidden-xs" @click="gotoPage(1)" >第一頁</a></li>
							<li class="page-item" v-if="pageData.current_page !== 1"><a class="option page-link hidden-xs" @click="gotoPage(pageData.current_page - 1)" >上一頁</a></li>
							<li class="page-item" v-if="breakPoint < this.pageData.current_page">
								<a class="option page-link" 
								@click="gotoPage(1)" >
								1
								</a>
							</li>
							<li class="page-item" v-if="breakPoint < this.pageData.current_page">
								<a class="option page-link" 
								@click="gotoPage(pageData.current_page - breakPoint)">
								...
								</a>
							</li>
							<li class="page-item" v-for="(item, index) in eachPage" 
								:key="index" 
								:class="{'hidden': !pageNumVisible(item)}">
								<a class="option page-link" 
								@click="gotoPage(item)"
								:class="{active: item == pageData.current_page}">
								{{item}}
								</a>
							</li>
							<li class="page-item" v-if="pageData.last_page > this.pageData.current_page + (breakPoint - 1)">
								<a class="option page-link" 
								@click="gotoPage(pageData.current_page + breakPoint)">
								...
								</a>
							</li>
							<li class="page-item" v-if="pageData.last_page > this.pageData.current_page + (breakPoint - 1)">
								<a class="option page-link" 
								@click="gotoPage(pageData.last_page)" >
								{{pageData.last_page}}
								</a>
							</li>
							<li class="page-item" v-if="pageData.current_page !== pageData.last_page"><a class="option page-link hidden-xs" @click="gotoPage(pageData.current_page + 1)" >下一頁</a></li>
							<li class="page-item" v-if="pageData.current_page !== pageData.last_page"><a class="option page-link hidden-xs" @click="gotoPage(pageData.last_page)" >最後一頁</a></li>
						</ul>
					</nav>
					
				</div>
				<div class="col-md-12 btn-section" v-if="pageLoaded">
					<div v-if="pageData.current_page == pageData.last_page" class="scrolldown-endpoint">
						<img src="https://nizawa.shuo-guo.net/img/findmore.png" alt="">
						<h4>{{i18n.post_out}}</h4>
						<p v-html="i18n.post_find_contact"></p>
					</div>
					<img v-if="isLoadingLearnMore" width="50" src="https://nizawa.shuo-guo.net/img/icon/loading-spinner.svg">
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
				actionLock: false,
				eachPage: [],
				breakPoint: 3,
            }
		},
		created() {
			this.getData()
			this.getCategories()
		},
		watch: {
			urlPath() {
				console.log(123)
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
				let vo = {
					cate: this.selectedCategory,
					keyword: this.keyword
				}

				$('.loading-bar').show()

				axios.post(this.urlPath, vo)
					.then(res => {
						this.pageData = res.data
						this.pageLoaded = true
						this.eachPage = []
						for (let index = 0; index < res.data.last_page; index++) {
							this.eachPage.push(index + 1)
						}
						$('.loading-bar').hide()
						// this.scrollMore()
					})
				// if (!this.pageLoaded) {
				// 	let vo = {
				// 		cate: this.selectedCategory,
				// 		keyword: this.keyword
				// 	}

				// 	$('.loading-bar').show()

				// 	axios.post(this.urlPath, vo)
				// 		.then(res => {
				// 			this.pageData = res.data
				// 			this.pageLoaded = true
				// 			for (let index = 0; index < res.data.last_page; index++) {
				// 			this.eachPage.push(index + 1)
				// 			}
				// 			$('.loading-bar').hide()
				// 			// this.scrollMore()
				// 		})
				// }				
			},
			gotoPage(page) {
                let checkPage = this.urlPath.match('page=')

                if (checkPage) {
                    let pathArray = this.urlPath.split('?')
                    let pageStrIndex

                    pathArray.forEach(elm => {
                        if (elm.match('page=')) {
                            pageStrIndex = pathArray.indexOf(elm)
                        }
                    })

                    pathArray[pageStrIndex] = `page=${page}`
                    
                    this.urlPath = pathArray.join('?')
                } else {
                    const url = `${this.urlPath}?page=${page}`

                    this.urlPath = url
                }
			},
			pageNumVisible(item) {	
				if (item > this.pageData.current_page + (this.breakPoint - 1)) {
					return false
				}
				if (item + (this.breakPoint - 1) < this.pageData.current_page) {
					return false
				}
				return true
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
