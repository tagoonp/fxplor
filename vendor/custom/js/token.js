var jwt = {
  init(){
    if(current_token === 'undefined'){
      // Regenerate new token
      var param = {
        api: conf.api_key
      }
      var jxr = $.post(conf.api + 'token.php?stage=generate', param, function(){}, 'json')
                 .always(function(i){
                   if(i.status = 'success'){
                     window.localStorage.setItem(conf.prefix + 'token', i.token)
                     current_token = i.token
                     // jwt.chkToken(a)
                     console.log(i.token);
                   }else{
                     alert('Invalid access token')
                   }
                 })
    }else{
      // Check live token
      var param = {
        api: conf.api_key,
        token: current_token
      }
      var jxr = $.post(conf.api + 'token.php?stage=token_check', param, function(){}, 'json')
                 .always(function(i){
                   if(i.status = 'live'){
                     window.localStorage.setItem(conf.prefix + 'token', i.token)
                     current_token = i.token
                     jwt.chkToken()
                   }else if(i.status = 'refresh'){
                     window.localStorage.setItem(conf.prefix + 'token', i.token)
                     current_token = i.token
                     jwt.chkToken()
                   }else{
                     alert('Invalid access token')
                   }
                 })
    }
  },
  chkToken(){
    // console.log(current_token);
  }
}

jwt.init()
