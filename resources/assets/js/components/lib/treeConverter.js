
export default {

  convert(categories) {
    let parent = []
    let root = [{
      active: true,
      children: [],
      expanded: true,
      title: '全部類別',
      data: null,
      key: 'ALL'
    }]

    parent = _.compact(categories.map(item => {
      if (!item.parentId) {
        return {
          children: [],
          expanded: false,
          title: item.name,
          data: item,
          key: item.guid
        }
      }
    }))

    parent.forEach(item => {
      item.children = _.compact(categories.map(child => {
        if (child.parentId) {
          if (child.parentId == item.data.guid) {
            return {
              children: [],
              expanded: false,
              title: child.name,
              data: child,
              key: child.guid
            }
          }
        }
      }))

      item.children.forEach(elm => {
        elm.children = _.compact(categories.map(child => {
          if (child.parentId) {
            if (child.parentId == elm.data.guid) {
              return {
                children: [],
                expanded: false,
                title: child.name,
                data: child,
                key: child.guid
              }
            }
          }
        }))
      })
    })

    root[0].children = parent

    return root;
  }
}