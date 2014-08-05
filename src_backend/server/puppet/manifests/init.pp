class { 'database::install': }
class { 'phpmyadmin::install': }


# OLD:
#exec { 'apt_update':
#  command => 'apt-get update',
#  path    => '/usr/bin'
#}
#
#exec { 'apt_librcre':
#  command => '/usr/bin/apt-get install libpcre3-dev --quiet --yes',
#  require => Exec['apt_update'],
#}
#
#class { 'git::install': }
#class { 'subversion::install': }
#class { 'apache2::install': }
#class { 'php5::install': }
#class { 'mysql::install': }
#class { 'highly::install': }
#class { 'phalcon::install': }
##class { 'phalconphp':}
#class { 'phpmyadmin::install': }
#
#
#exec { 'final':
#    path => '/vagrant/files/cphalcon/build/',
#    command => './install',
#    require => Exec['apt_librcre'],
#}