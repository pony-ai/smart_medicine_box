//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    nData:{},
    box:{
        percent:'60'
      },
    x: 270,
    y: 0,
    toView: 'green',
  },
  tap: function (e) {
    this.setData({
      x: 30,
      y: 30
    });
  },
  upper(e) {
    console.log(e)
  },

  lower(e) {
    console.log(e)
  },

  scroll(e) {
    console.log(e)
  },

  scrollToTop() {
    this.setAction({
      scrollTop: 0
    })
  },

  tap() {
    for (let i = 0; i < order.length; ++i) {
      if (order[i] === this.data.toView) {
        this.setData({
          toView: order[i + 1],
          scrollTop: (i + 1) * 200
        })
        break
      }
    }
  },

  tapMove() {
    this.setData({
      scrollTop: this.data.scrollTop + 10
    })
  },
  onChange: function (e) {
    console.log(e.detail)
  },
  onScale: function (e) {
    console.log(e.detail)
  },
  onLoad:function(event){
    var self = this;
    var url = app.globalData.dataSource;
    wx.getSystemInfo({
      success: function (res) {
        console.log(res);
        // 屏幕宽度、高度
        console.log('height=' + res.windowHeight);
        console.log('width=' + res.windowWidth);
        // 高度,宽度 单位为px
        self.setData({
          windowHeight: res.windowHeight,
          windowWidth: res.windowWidth
        })
      }
    }),
    wx.request({
      url: url + '/api/notice/lst',
      method: 'GET',
      header: {
        "content-type": "json"
      },
      success: function (res) {
        self.setData({
          nData: res.data
        })
      },
      fail: function (error) {
        console.log(error)
      }
    })
  },
  onShow:function(){
    this.onLoad()
  },
  formSubmit:function(e){
    console.log('id:',e.detail.value)
    var self = this;
    var url = app.globalData.dataSource;
    wx.request({
      url: url + '/api/notice/del/'+e.detail.value.id,
      method: 'GET',
      header: {
        "content-type": "json"
      },
      success: function (res) {
        self.onLoad()
      },
      fail: function (error) {
        console.log(error)
      }
    })

  },
  addNotice:function(){
    wx.navigateTo({
      url: './addNotice/addNotice',
    })
  }
})
