// pages/add/addMedicine/addMedicine.js

//获取应用实例
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    index: 1,
    array: ['处方药', '非处方药'],
    multiIndex: [2, 1, 1],
    multiArray:[[1,2,3,4],[1,2,3,4],['粒','片','丸','瓶','袋']],
    date:'2021-01-01',
    box:'a'
  }, 
  bindPickerChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      index: e.detail.value
    })
  },
  bindMultiPickerChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      multiIndex: e.detail.value
    })
  },
  bindDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date: e.detail.value
    })
  }, 
  formSubmit: function (e) {
    console.log('form发生了submit事件，携带数据为：', e.detail.value);
    // return false;
    var url = app.globalData.dataSource;
    wx.request({
      url: url +'/api/medicine/add',
      data: {
        'box':e.detail.value.box,
        'mName': e.detail.value.mName,
        'mDoes': e.detail.value.mDoes,
        'cate': e.detail.value.cate,
        'indications': e.detail.value.indications,
        'attention': e.detail.value.attention,
        'producers': e.detail.value.producers,
        'effectiveDate': e.detail.value.effectiveDate,
        },
      method:'POST',
      header: {
        "Content-Type": "application/x-www-form-urlencoded"
      }, 
      success: function (res) {
        wx.switchTab({
          url: '../add',
          fail: function () {
            console.info("跳转失败")
          }
        })
      },
      fail:function(res){
        console.log(res);
      }
    })
    // 测试代码
    // wx.switchTab({
    //   url: '../add',
    //   succsee: function () {
    //     var page = getCurrentPages().pop();
    //     if (page == undefined || page == null) return;
    //     page.onLoad();
    //   },
    //   fail: function () {
    //     console.info("跳转失败")
    //   }
    // })
  },
  formReset: function () {
    console.log('form发生了reset事件')
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
      var that = this;
      that.setData({box:options.box})
  },
})