# -*- mode: ruby -*-
# vi: set ft=ruby :

ENV["LC_ALL"] = "en_US.UTF-8"

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "ubuntu/xenial64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  config.vm.box_check_update = true

  # Time in seconds that Vagrant will wait for the machine to boot and be accessible.
  config.vm.boot_timeout = 600

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # The hostname the machine should have. 
  config.vm.hostname = "localhost"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.
  config.vm.provider "virtualbox" do |vb|
    vb.name = "xenial-cotton-100-pasento"
    # vb.memory = 1024
    # vb.cpus = 1
  end

  # Define a Vagrant Push strategy for pushing to Atlas. Other push strategies
  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define "atlas" do |push|
  #   push.app = "YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME"
  # end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
    echo "nameserver 8.8.8.8" | tee /etc/resolv.conf > /dev/null
    apt-get update --fix-missing
    apt-get install -y vim curl build-essential python-software-properties git zip unzip
    debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
    debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"
    apt-get install -y apache2 mysql-client mysql-server php-mysql php-curl php-json php-cgi php-gd php-gettext php-mbstring php libapache2-mod-php
    # mysql -uroot -proot -e "CREATE DATABASE cotton DEFAULT CHARSET=UTF8"
    # mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON cotton.* to 'root'@'localhost' IDENTIFIED BY 'root'"
    a2enmod rewrite
    a2enmod headers
    a2enmod expires
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
    mv -v /var/www/html /var/www/html.default
    ln -fs /vagrant/public /var/www/html
    sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.0/apache2/php.ini
    sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.0/apache2/php.ini
    service apache2 restart
    curl --silent https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
  SHELL
end
