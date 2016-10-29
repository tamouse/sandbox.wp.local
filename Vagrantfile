# -*- mode: ruby -*-
# vi: set ft=ruby :

# Set these up in the host machine's `/etc/hosts` file:
BOX_NAME="sandbox.wp.local"
DEFAULT_IP="192.168.33.35"

require "resolv"

def my_ip
  @my_ip ||= Resolv::Hosts.new.getaddress(BOX_NAME) || DEFAULT_IP
rescue
  @my_ip ||= DEFAULT_IP
end
Vagrant.configure(2) do |config|

  config.ssh.forward_agent = true

  config.vm.define :sandbox_wp do |sb|
    sb.vm.box      = "ubuntu/trusty64"
    sb.vm.network  "private_network", ip: my_ip
    sb.vm.network  "forwarded_port", guest: 80, host: 8088
    sb.vm.hostname = BOX_NAME

    sb.vm.provider "virtualbox" do |vb|
      # Display the VirtualBox GUI when booting the machine
      # vb.gui = true

      # Customize the amount of memory on the VM:
      vb.customize ["modifyvm", :id, "--memory", "2048"]
      vb.customize ["modifyvm", :id, "--vram", "18"]
      vb.customize ["modifyvm", :id, "--cpus", "2"]
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    end
  end

  config.vm.provision :ansible do |a|
    a.playbook = 'ansible/sandbox.yml'
    # a.verbose  = 'vvvv'
  end
end
