const conf = {
  domain: 'http://localhost/econsult2019/',
  api: 'http://localhost/econsult2019/controller/',
  prefix: 'hddsx2x_'
}

var current_user = window.localStorage.getItem(conf.prefix + '_uid')
var current_role = window.localStorage.getItem(conf.prefix + '_role')
