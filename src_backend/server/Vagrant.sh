#!/bin/bash
# Using Precise32 Ubuntu

sudo apt-get update
#
# For PHP 5.5
#
sudo apt-get install -y python-software-properties
sudo add-apt-repository ppa:ondrej/php5
sudo apt-get update

#
# MySQL with root:<no password>
#
export DEBIAN_FRONTEND=noninteractive
echo mysql-server-5.1 mysql-server/root_password password vagrant | debconf-set-selections
echo mysql-server-5.1 mysql-server/root_password_again password vagrant | debconf-set-selections
apt-get -q -y install mysql-server


#
# PHP
#
sudo apt-get install -y php5 php5-dev apache2 libapache2-mod-php5 php5-mysql php5-curl libpcre3-dev

#
# Redis
#
sudo apt-get install -y redis-server

#
# MongoDB
#
sudo apt-get install -y mongodb-clients mongodb-server

#
# Utilities
#
sudo apt-get install -y make curl htop git-core vim zlib1g-dev build-essential libssl-dev libreadline-dev libyaml-dev libsqlite3-dev sqlite3 libxml2-dev libxslt1-dev libcurl4-openssl-dev python-software-properties

##remove current ruby
sudo aptitude purge ruby -y
#


## install rvm
cd
sudo wget http://ftp.ruby-lang.org/pub/ruby/2.1/ruby-2.1.2.tar.gz
tar -xzvf ruby-2.1.2.tar.gz
cd ruby-2.1.2/
sudo ./configure
sudo make
sudo make install
echo "gem: --no-ri --no-rdoc" > ~/.gemrc

#setup livereload on WWW page
sudo gem install guard guard-livereload
cd /vagrant/www/
sudo guard init
sudo guard init livereload



#
# Redis Configuration
# Allow us to Remote from Vagrant with Port
#
sudo cp /etc/redis/redis.conf /etc/redis/redis.bkup.conf
sudo sed -i 's/bind 127.0.0.1/bind 0.0.0.0/' /etc/redis/redis.conf
sudo /etc/init.d/redis-server restart

#
# MySQL Configuration
# Allow us to Remote from Vagrant with Port
#
sudo cp /etc/mysql/my.cnf /etc/mysql/my.bkup.cnf
# Note: Since the MySQL bind-address has a tab cahracter I comment out the end line
sudo sed -i 's/bind-address/bind-address = 0.0.0.0#/' /etc/mysql/my.cnf

#
# Grant All Priveleges to ROOT for remote access
#
mysql -u root -Bse "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'vagrant' WITH GRANT OPTION;"
sudo service mysql restart



#
# Composer for PHP
#
sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

#
# Apache VHost
#
cd ~
#echo '<VirtualHost *:80>
#        DocumentRoot /vagrant/www
#</VirtualHost>
#
#<Directory "/vagrant/www">
#        Options Indexes Followsymlinks
#        AllowOverride All
#        Require all granted
#</Directory>' > vagrant.conf

#echo '<VirtualHost *:80>
#	ServerAdmin webmaster@localhost
#
#	DocumentRoot /vagrant/www
#	#RewriteLogLevel 9
#	#RewriteLog ${APACHE_LOG_DIR}/vagrant.rewrite.log
#
#    # correect caching issue wher edited images do not refresh http://www.mabishu.com/blog/2013/05/07/solving-caching-issues-with-vagrant-on-vboxsf/
#    EnableSendfile off
#
#	<Directory /vagrant/www>
#	   Options Indexes Followsymlinks
#       AllowOverride All
#       Require all granted
#	</Directory>
#
#	ErrorLog ${APACHE_LOG_DIR}/vagrantpress.error.log
#
#	# Possible values include: debug, info, notice, warn, error, crit,
#	# alert, emerg.
#	LogLevel warn
#
#	CustomLog ${APACHE_LOG_DIR}/vagrantpress.access.log combined
#</VirtualHost>' > vagrant.conf
#
sudo cp /vagrant/src/server/files/etc/apache2/vagrant.conf /etc/apache2/sites-available
sudo a2enmod rewrite

#
# Install PhalconPHP
# Enable it
#
#cd /vagrant/files/cphalcon/build/
cd ~
git clone --depth=1 https://github.com/phalcon/cphalcon.git
cd cphalcon/build
sudo ./install

echo "extension=phalcon.so" > phalcon.ini
sudo mv phalcon.ini /etc/php5/mods-available
sudo php5enmod phalcon
sudo php5enmod curl

#
# Update PHP Error Reporting
#
sudo sed -i 's/short_open_tag = Off/short_open_tag = On/' /etc/php5/apache2/php.ini
sudo sed -i 's/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = E_ALL/' /etc/php5/apache2/php.ini
sudo sed -i 's/display_errors = Off/display_errors = On/' /etc/php5/apache2/php.ini


#
# Install PhalconPHP DevTools
#
cd ~
echo '{"require": {"phalcon/devtools": "dev-master"}}' > composer.json
composer install
rm composer.json

sudo mkdir /opt/phalcon-tools
sudo mv ~/vendor/phalcon/devtools/* /opt/phalcon-tools
sudo ln -s /opt/phalcon-tools/phalcon.php /usr/bin/phalcon
sudo rm -rf ~/vendor

#
# Reload apache
#
sudo a2ensite vagrant
sudo a2dissite 000-default
sudo service apache2 reload
sudo service apache2 restart
sudo service mongodb restart

echo -e "----------------------------------------"
echo -e "To create a Phalcon Project:\n"
echo -e "----------------------------------------"
echo -e "$ cd /vagrant/www"
echo -e "$ phalcon project projectname\n"
echo -e
echo -e "Then follow the README.md to copy/paste the VirtualHost!\n"

echo -e "----------------------------------------"
echo -e "Default Site: http://localhost:6080/"
echo -e "----------------------------------------"