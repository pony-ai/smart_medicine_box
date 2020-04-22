//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    nData:{},
    box:{
        percent:'60'
      }
  },
  onLoad:function(event){
    var self = this;
    var url = app.globalData.dataSource;
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
  addNotice:function(){
    wx.navigateTo({
      url: './addNotice/addNotice',
    })
  }
})
