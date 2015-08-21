# -*- mode: ruby -*-
# vi: set ft=ruby :


Vagrant.configure(2) do |config|
  config.vm.box = "avenuefactory/lamp"

  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder "./", "/var/www/gladys"

end
