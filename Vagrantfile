# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "precise64"
  config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/precise/current/precise-server-cloudimg-amd64-vagrant-disk1.box"

  config.vm.network :forwarded_port, guest: 80, host: 6080
  # Connect to IP
  # --------------------
  #config.vm.network :private_network, ip: "192.168.5.0"

   # Set the timezone to the host timezone
   require 'time'
   timezone = 'Etc/GMT' + ((Time.zone_offset(Time.now.zone)/60)/60).to_s
   config.vm.provision :shell, :inline => "if [ $(grep -c UTC /etc/timezone) -gt 0 ]; then echo \"#{timezone}\" | sudo tee /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata; fi"

    # Set the Timezone to host timezone require 'time' offset = ((Time.zoneoffset(Time.now.zone)/60)/60) zonesufix = offset >= 0 ? "+#{offset.tos}" : "#{offset.tos}" timezone = 'Etc/GMT' + zone_sufix config.vm.provision :shell, :inline => "echo \"#{timezone}\" | sudo tee /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata"

   # Provisioning Script
   # --------------------
   config.vm.provision "shell", path: "src/server/Vagrant.sh"

  #config.vm.provision :shell do |shell|
  # shell.inline = "/usr/bin/apt-get install libpcre3-dev --quiet --yes";
  #end

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "src/server/puppet/manifests"
    puppet.module_path = "src/server/puppet/modules"
    puppet.manifest_file  = "init.pp"
    puppet.options="--verbose --debug"
  end

    # Synced Folder
   # --------------------
   config.vm.synced_folder ".", "/vagrant/", :mount_options => [ "dmode=777", "fmode=666" ]
   config.vm.synced_folder "./www", "/vagrant/www/", :mount_options => [ "dmode=775", "fmode=644" ], :owner => 'www-data', :group => 'www-data'


end