# -*- mode: ruby -*-
# vi: set ft=ruby :

BOX_NAME="sandbox.wp.local"
DEFAULT_IP="192.168.33.35"

require "resolv"

def my_ip
  @my_ip ||= Resolv::Hosts.new.getaddress(BOX_NAME) || DEFAULT_IP
rescue
  @my_ip ||= DEFAULT_IP
end

SCRIPT = <<-PROVISION
export DEBIAN_FRONTEND=noninteractive
apt-get update -qq
apt-get install -y \
  build-essential \
  debconf-utils \
  git git-core \
  curl \
  emacs24 \
  nginx fcgiwrap \
  php5 php5-cgi php5-cli php5-curl php5-dev php5-fpm \
  mysql-server mysql-client \
  php5-mysql

git config --global user.name "tamouse"
git config --global user.email "tamouse@gmail.com"

echo 'export EDITOR=emacs' >> .profile
echo 'export VISUAL=emacs' >> .profile

PROVISION

Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "private_network", ip: my_ip
  config.vm.hostname = BOX_NAME

  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    # vb.gui = true

    # Customize the amount of memory on the VM:
    vb.customize ["modifyvm", :id, "--memory", "2048"]
    vb.customize ["modifyvm", :id, "--vram", "12"]
    vb.customize ["modifyvm", :id, "--cpus", "2"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.provision "shell", inline: SCRIPT
end
