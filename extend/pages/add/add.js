// pages/add/add.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    scanData:{
      result:null,
      type:null,
    },
    mData:[
      {
        id: 1,
        mName: "阿莫西林胶囊",
        cate: 1,
        indications: "消炎",
        attention: "无",
        mDoes: "2,1,1",
        effectiveDate: "2021-01-01 00:00:00",
        producers: "哈尔滨制药厂",
}
    ]
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var url = app.globalData.dataSource;
    wx.request({
      url: url+'/api/medicine/lst',
      method: 'GET', header: {
        "content-type": "json"
      },
      success: function (res) {
        that.setData({
          mData: res.data
        })
      },
    })
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

  },
  scanCode: function () {
    var myThis = this;
    wx.navigateTo({
      url: './addMedicine/addMedicine'
    })
    // wx.scanCode({
    //   success: function (res) {
    //     wx.navigateTo({
    //       url: './addMedicine/addMedicine?box=' + res.result
    //     })
    //   },
    // })
  }
})