# Install phalcon framework

class phalcon::install {

#  exec { 'clone phalcon':
##    path => "/vagrant/files/",
#    command => "/usr/bin/git clone --depth=1 git://github.com/phalcon/cphalcon.git",
#  }

#  vcsrepo { '/home/vagrant/':
#    ensure => present,
#    provider => git,
#    source => 'git://github.com/phalcon/cphalcon.git',
#    revision => 'master'
#  }


#  exec { 'build PHALCON':
#    path => '/vagrant/files/cphalcon/build/',
#    command => "./install",
#    require => Exec['apt_librcre'],
#    logoutput => true,
#    user => root
#  }

  exec { 'add extension to php.ini (APACHE2)':
#    path => "/usr/bin/",
    command => '/bin/sh -c "echo \'extension=phalcon.so\' >> /etc/php5/apache2/php.ini"',
    user => root
  }

  exec { 'add extension to php.ini (CLI)':
#path => ['/usr/bin', '/bin', '/sbin'],
    command => '/bin/sh -c "echo \'extension=phalcon.so\' >> /etc/php5/cli/php.ini"',
    user => root
  }

#  exec {'restart apache2':
#    command => '/etc/init.d/apache2 restart',
#    user => root
#  }

}


# cd /vagrant/files/cphalcon/build/ && sudo ./install && /etc/init.d/apache2 restart

