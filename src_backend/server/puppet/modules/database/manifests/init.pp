# Install base needed files for highly

class database::install {

  $mysql-password = 'vagrant'
  $mysql-database = 'vagrant_dev'

  $mysql-user = 'vagrant_usr'
  $mysql-user-pwd = 'd3v_hvagr4ntlY@@'

  # Create the database
  exec { 'create-database':
    unless  => "/usr/bin/mysql -u root -p${mysql-password} ${$mysql-database}",
    command => "/usr/bin/mysql -u root -p${mysql-password} --execute='create database ${$mysql-database}'",
  }

  exec { 'create-user':
    unless  => "/usr/bin/mysql -u ${mysql-user} -p${$mysql-user-pwd} ${$mysql-database}",
    command => "/usr/bin/mysql -u root -p${mysql-password} --execute=\"GRANT ALL PRIVILEGES ON ${$mysql-database}.* TO '${mysql-user}'@'localhost' IDENTIFIED BY '${$mysql-user-pwd}'\"",
  }

  # Import a MySQL database
  file { '/tmp/dump.sql':
    source => 'puppet:///modules/database/dump.sql'
  }

  exec { 'load-db':
    command => "/usr/bin/mysql -u root -p${mysql-password} ${$mysql-database} < /tmp/dump.sql && touch /home/vagrant/db-created",
    creates => '/home/vagrant/db-created',
  }

  # Copy a working wp-config.php file for the vagrant setup.
  #file { '/vagrant/phalcon/wp-config.php':
  #  source => 'puppet:///modules/phalcon/wp-config.php'
  #}

}
