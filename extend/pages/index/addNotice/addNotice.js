// pages/index/addNotice/addNotice.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    member:['pony','rose'],
    memIndex:'0',
    mData:null,
    medIndex:'0',
    startDate: '2020-04-20',
    endDate: '2020-04-30',
    fIndex:'0',
    frequency: ['每天一次', '每天两次','每天三次'],
    showFirst:true,
    showSecond: false,
    showThird: false,
    firstTime: '07:01',
    secondTime: '12:01',
    thirdTime: '17:01',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var url = app.globalData.dataSource;
    var that = this;
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
  bindStartDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      startDate: e.detail.value
    })
  },
  bindEndDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      endDate: e.detail.value
    })
  }, 
  bindFrequencyChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    if (e.detail.value==1){
      this.setData({
        showSecond: true,
        showThird: false
      })
    } else if(e.detail.value == 2){
      this.setData({
        showSecond: true,
        showThird:true
      })
    }else{
      this.setData({
        showFirst: true,
        showSecond: false,
        showThird: false,
      })
    }
    this.setData({
      fIndex: e.detail.value,
    })
  },
  bindFirstTimeChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      firstTime: e.detail.value
    })
  },
  bindSecondTimeChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      secondTime: e.detail.value
    })
  },
  bindThirdTimeChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      thirdTime: e.detail.value
    })
  }, 
  formSubmit: function (e) {
    console.log('form发生了submit事件，携带数据为：', e.detail.value)
    var url = app.globalData.dataSource;
    wx.request({
      url: url +'/api/notice/add',
      data: {
        'member': e.detail.value.member,
        'mName': e.detail.value.mName,
        'startDate': e.detail.value.startDate,
        'endDate': e.detail.value.endDate,
        'frequency': e.detail.value.frequency,
        'firstTime': e.detail.value.firstTime,
        'secondTime': e.detail.value.secondTime,
        'thirdTime': e.detail.value.thirdTime,
        'isMeal': e.detail.value.isMeal
        },
      method:'POST',
      header: {
        "Content-Type": "application/x-www-form-urlencoded"
      }, 
      success: function (res) {
        wx.switchTab({
          url: '../index',
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
    //   url: '../index',
    //   fail: function () {
    //     console.info("跳转失败")
    //   }
    // })
  },
})