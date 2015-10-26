# MotoBikes-Store
A Simple and exampe MotoBike Store with laravel framework

# Problem
Using Laravel as a framework (http://laravel.com), create an application for motorbikes.
Use Eloquent for the models, and Blade-syntax in the views. Start with an empty Laravel project.

Protected admin-system:
* A form to register a motorbike (Store at least make and model, cc, color, weight, price and one image)

Public part:
* Page which lists all registered motorbikes.
* Page with detailed information about one selected motorbike.
* Add pagination to the list, showing a maximum of 5 bikes per page.
* Add sorting, it should be possible to sort by price and by date (date the bike was added)
* Add filtering (for example by color)

# Config
This simple project run with help of nginx on mac OS X Yosemite you must install fast-cgi as php cgi.
To config your localcomputer to run nginx and fast-cgi you can read [helpful article from digital ocean which about installing and config LEMP on ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-12-04).

# Road Map 
  * Ver 0.5
    [x] build Backend framework
  * Ver 1.0
    [ ] build Frontend with jquery and angular.js
  
# Scenario
  Enter main page as '/' route and then you can register admin user after click on login link in header(for first time login route redirect to register admin user link after that you can login to dashboard with login link).
  If you logged in as admin user you can see all bike and register new one otherwise only you can see bike with detailes information.
  Also search, filtering and sorting feature added to main page.

# Unit test
  Unit test implemented with help of testing module in laravel which implemenet based on phpunit. you can run php test by run below command in root folder of project.
  > phpunit
  
