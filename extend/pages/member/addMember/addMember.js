// pages/member/addMember/addMember.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    items: [
      { name: '1', value: '男', checked: 'true' },
      { name: '0', value: '女' },
    ]
  },

  formSubmit: function (e) {
    console.log('提交数据：', e.detail.value);
    var url = app.globalData.dataSource;
    wx.request({
      url: url+'/api/member/add',
      method:'POST',
      data:{
        name:e.detail.value.name,
        gender:e.detail.value.gender,
        age:e.detail.value.age,
        note:e.detail.value.note
      }, 
      header: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      success: function (res) {
        wx.switchTab({
          url: '../member',
          succsee:function(){
            var page = getCurrentPages().pop();
            if (page == undefined || page == null) return;
            page.onLoad();
          },
          fail: function () {
            console.info("跳转失败")
          }
        })
      },
      fail: function (res) {
        console.log(res);
      }
    })
  },

  radioChange: function (e) {
    console.log('radio发生change事件，携带value值为：', e.detail.value)
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})