export default {
    data() {
        return {
            currentPath: window.location.origin,
            mainCate: null,
            secondCate: null,
            rootLayer: [],
            allCategories: [],
            productContent: {
                'zh-TW': {
                    Temperature: 'room',
                    productTitle: null,
                    serialNumber: null,
                    productDescription: {
                        step: null,
                        option: null,
                        spec: null
                    },
                    shortDescription: null,
                    price: 1,
                    isPublish: false,
                    locale: 'zh-TW',
                    quantity: 9999999,
                    rule: null,
                    discountedPrice: null,
                    customPath: 'null',
                    schedulePost: null,
                    scheduleDelete: null,
                    productStatus: 'instock',
                    socialImage: null,
                    seoTitle: null,
                    seoDescription: null,
                    seoKeyword: null,
                    productInformation: {
                        weight: null,
                        size: {
                            productLength: null,
                            productWidth: null,
                            productHeight: null
                        }
                    },
                    reserveStatus: true,
                    productType: 'simple',
                    featureImage: null,
                    mainCategory: null,
                    subCategory: null,
                    productCategory: null,
                    album: [],
                    // subProduct: []
                },
                'zh-CN': {
                    Temperature: 'room',
                    productTitle: null,
                    serialNumber: null,
                    productDescription: {
                        step: null,
                        option: null,
                        spec: null
                    },
                    shortDescription: null,
                    price: 1,
                    isPublish: false,
                    locale: 'zh-CN',
                    quantity: 9999999,
                    rule: null,
                    discountedPrice: null,
                    customPath: 'null',
                    schedulePost: null,
                    scheduleDelete: null,
                    productStatus: 'instock',
                    socialImage: null,
                    seoTitle: null,
                    seoDescription: null,
                    seoKeyword: null,
                    productInformation: {
                        weight: null,
                        size: {
                            productLength: null,
                            productWidth: null,
                            productHeight: null
                        }
                    },
                    reserveStatus: true,
                    productType: 'simple',
                    featureImage: null,
                    mainCategory: null,
                    subCategory: null,
                    productCategory: null,
                    album: [],
                    // subProduct: []
                },
                'en': {
                    Temperature: 'room',
                    productTitle: null,
                    serialNumber: null,
                    productDescription: {
                        step: null,
                        option: null,
                        spec: null
                    },
                    shortDescription: null,
                    price: 1,
                    isPublish: false,
                    locale: 'en',
                    quantity: 9999999,
                    rule: null,
                    discountedPrice: null,
                    customPath: 'null',
                    schedulePost: null,
                    scheduleDelete: null,
                    productStatus: 'instock',
                    socialImage: null,
                    seoTitle: null,
                    seoDescription: null,
                    seoKeyword: null,
                    productInformation: {
                        weight: null,
                        size: {
                            productLength: null,
                            productWidth: null,
                            productHeight: null
                        }
                    },
                    reserveStatus: true,
                    productType: 'simple',
                    featureImage: null,
                    mainCategory: null,
                    subCategory: null,
                    productCategory: null,
                    album: [],
                    // subProduct: []
                }
            },
            subProductForm: {
                subTitle: null,
                subSerialNumber: null,
                subQuantity: null,
                subPrice: null,
                subDiscountPrice: null
            },
            isSubmit: false,
            noShow: false,
            showSwitchTips: false,
            subproductFormVisible: false,
        }
    },

    compute() {
        return {
            secLayer() {
                if (this.productContent[this.selectedLocale].mainCategory) {
                    return _.filter(this.allCategories, ['parentId', this.productContent[this.selectedLocale].mainCategory]).map(elm => {
                        return {
                            'name': elm.categoryTitle,
                            'guid': elm.categoryGuid,
                            'parentId': elm.parentId
                        }
                    })
                } else {
                    return []
                }
            },
            thirdLayer() {
                if (this.productContent[this.selectedLocale].subCategory) {
                    return _.filter(this.allCategories, ['parentId', this.productContent[this.selectedLocale].subCategory]).map(elm => {
                        return {
                            'name': elm.categoryTitle,
                            'guid': elm.categoryGuid,
                            'parentId': elm.parentId
                        }
                    })
                } else {
                    return []
                }
            },
            schedulePostDate() {
                if (this.productContent.schedulePost) {
                    return moment(this.productContent.schedulePost).format();
                } else {
                    return null;
                }
            },
            scheduleDeleteDate() {
                if (this.productContent.scheduleDelete) {
                    return moment(this.productContent.scheduleDelete).format();
                } else {
                    return null;
                }
            },
            scheduleDeleteConfigfunctionName() {
                if (this.schedulePostDate) {
                    return {
                        minDate: moment(this.schedulePostDate)
                    }
                } else {
                    return {
                        minDate: moment()
                    }
                }
            },
            checkTime() {
                if (this.productContent.schedulePost && this.productContent.scheduleDelete) {
                    var schedulePost = this.productContent.schedulePost._d.getTime();
                    var scheduleDelete = this.productContent.scheduleDelete.getTime();

                    if (schedulePost > scheduleDelete) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }

            },
            isAllowToSave() {
                return true
                return this.checkPrice
            }
        }
    }
}