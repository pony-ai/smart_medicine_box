// pages/member/member.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    toView: 'green',
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
  onLoad:function(){
    var self = this;
    var url = app.globalData.dataSource;
    wx.request({
      url: url+'/api/member/lst',
      method: 'GET', 
      header: {
        "content-type": "json"
      },
      success: function (res) {
        self.setData({
          member: res.data
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
  buttonMember:function(){
    wx.navigateTo({
      url: './addMember/addMember',
      success: function(res) {},
      fail: function(res) {
        console.log('跳转失败...');
      },
    })
  }
})