# franchistemplate - a both front-end and php back-end boilerplate with painless setup


## Features

### BACK:

- VAGRANT environment with LAMP (Apache 2 - PHP 5.5 - MySQL 5.1) using Precise Pangolin 64 Ubuntu 12.04 as base.
- MongoDB
- RedisServer
- *LiveReload (Under development)
- PHPMyAdmin
- PHALCON FRAMEWORK
- COMPOSER

### FRONT:

- GRUNT TASKS: cssmin,jsmin,jshint,concat,livereload,sass based on FireShell
- BOWER
- HTML template based on HTML5BOILERPLATE (jQuery,Modernizr,normalize.css)
- SASS


## Quick start

Choose one of the following options:

1. Download and Install VirtualBox (https://www.virtualbox.org/) and Vagrant (www.vagrantup.com)
2. Clone the git repo — `git clone
   https://github.com/h5bp/html5-boilerplate.git` - and checkout the tagged
   release you'd like to use.
3. Execute 'vagrant up' command on your terminal and wait (serious, go get some beer).
4. Access on your browser 'http://localhost:6080/'


## FAQ

1. To change any server configuration, look into /Vagrantfile and /src/server/Vagrant.sh files.

2. To automatic compile CSS and JS, run the grunt-dev.command (.bat on Windows).

3. To access PhpMyAdmin 'http://localhost:6080/phpmyadmin/'. (user:root pwd:vagrant). Database vagrant-dev created.
