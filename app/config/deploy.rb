set :application, "Feedme"
set :app_path,    "app"
set :symfony_env_prod, "prod"

set :domain,      "vps81183.ovh.net"
set :deploy_to,   "/var/www/feedme.com"
set :user,        "www-data"
set :use_sudo,     false

set :repository,  "https://github.com/UbikZ/sf2_feedme.git"
set :scm,         :git
set :branch,      "master"

ssh_options[:forward_agent] = true
default_run_options[:pty] = true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", app_path + "/sessions", web_path + "/uploads", "vendor"]
set :writable_dirs,     [app_path + "/cache", app_path + "/logs", app_path + "/sessions"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

set :dump_assetic_assets, true
set :use_composer, true
set :copy_vendors, true
set :update_vendors, true
set :model_manager, "doctrine"


role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

before 'symfony:assetic:dump', 'bower:install'

# Bower own configuration
namespace :bower do
    desc 'Run bower install'
    task :install do
        capifony_pretty_print "--> Installing bower components"
        invoke_command "sh -c 'cd #{latest_release} && bower install --config.interactive=false'"
        capifony_puts_ok
    end
    task :prune do
        capifony_pretty_print "--> Removing bower components"
        invoke_command "sh -c 'cd #{latest_release} && bower prune'"
        capifony_puts_ok
    end
end

# Parameters own configuration
set :parameters_dir, app_path + "/config"
set :parameters_file, "parameters.yml"

namespace :uploads do
    desc 'Upload to do'
    task :parameters do
        origin_file = parameters_dir + "/" + parameters_file if parameters_dir && parameters_file
        if origin_file && File.exists?(origin_file)
            ext = File.extname(parameters_file)
            relative_path = "app/config/parameters" + ext

            if shared_files && shared_files.include?(relative_path)
              destination_file = shared_path + "/" + relative_path
            else
              destination_file = latest_release + "/" + relative_path
            end
            try_sudo "mkdir -p #{File.dirname(destination_file)}"

            top.upload(origin_file, destination_file)
        end
    end
end

# For shared parameters file
# after 'deploy:setup', 'uploads:parameters'
# For unshared parameters file
before 'deploy:share_childs', 'uploads:parameters'

# Logger
logger.level = Logger::MAX_LEVEL
