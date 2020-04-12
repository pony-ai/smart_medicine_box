//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    userData:{},
    medicineData:[{
      date:"2020/4/10",
      mediName:"阿莫西林胶囊",
      box:"药仓a"
    },
    {
      date: "2020/4/10",
      mediName: "罗红霉素胶囊",
      box: "药仓b"
    }]
  },
  onLoad:function(event){
    var userDataUrl = app.globalData.dataSource;
    this.getUserData(userDataUrl);
  },
  getUserData:function(userDataUrl){
    var that = this;
    wx.request({
      url: userDataUrl,
      method:'GET',
      header:{
        "content-type":"json"
      },
      success:function(res){
        that.setData({
          userData:res.data
        })
      },
      fail:function(error){
        console.log(error)
      }
    })
  }
})
