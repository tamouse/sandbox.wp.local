# Brightbox Ruby Ansible Role

Used to install ruby with [Ansible](http://www.ansible.com/) using the [brightbox PPA](https://launchpad.net/~brightbox/+archive/ubuntu/ruby-ng) to avoid compiling.

## Using

The ruby version can be specified in 2 ways.

`.ruby-version` syntax

```yaml
- hosts: defaults
  roles:
    - { role: brightbox_ruby, ruby_version: 2.2.2 }
```

or by package name

```yaml
- hosts: defaults
  roles:
    - { role: brightbox_ruby, brightbox_ruby_version: ruby2.2 }
```

If using with [Vagrant](https://www.vagrantup.com/) you pass the value of your `.ruby-version` file directly.

```ruby
Vagrant.configure('2') do |config|
  config.vm.define do |dev|
    dev.vm.box = 'ubuntu/precise64'

    dev.vm.provision :ansible do |ansible|
      ansible.playbook = 'provisioning/development.yml'
      ansible.extra_vars = {
        ruby_version: `cat .ruby-version`.strip
      }
    end
  end
end
```

## License

* MIT
