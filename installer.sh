#!/bin/sh

#Update the folder permissions
sudo chmod -R 775 storage/ bootstrap/cache/ vendor/

# Install Composer Dependency
composer install

# Copy .env.example to .env
cp .env.example .env

# Update permission for .env
# This line is here because we will update .env from command line
sudo chmod 777 .env

#Start the installation process
#This will create the database along
php artisan application:install

# Install node dependency
npm install
