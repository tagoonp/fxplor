var user = {
  init(){
    console.log($('#txtUid').val());
    if($('#txtUid').val() == ''){
      window.location = conf.domain + 'login'
    }
  },
  logout(){
    window.localStorage.removeItem(conf.prefix + '_uid')
    window.localStorage.removeItem(conf.prefix + '_role')
    window.location = conf.domain + 'login'
  }
}

user.init()
