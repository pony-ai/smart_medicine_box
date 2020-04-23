// pages/member/member.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    
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