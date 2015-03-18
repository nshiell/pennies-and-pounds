A simple PHP application that given a number of pennies will calculate the minimum number of Sterling coins needed to make that amount.

# How to install
Assuming you have cloned this repository

1. You need to install other required packages, use composer
⋅⋅* This command will install behat and phpunit in bin/
2. You need to configure a webserver to run it.
For Apache 2 something like this:
```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/pennies-and-pounds/web
    
<Directory "/var/www/pennies-and-pounds">
    Options Indexes FollowSymLinks ExecCGI
    AllowOverride AuthConfig FileInfo
    Order allow,deny
    Allow from all
</Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```
3. To test run
⋅⋅* Unit test PHP with: ./bin/phpunit --bootstrap vendor/autoload.php src/
⋅⋅* BDD copy selenium server into bin/ then run
```
java -jar bin/selenium-server-*.jar
```
⋅⋅* then run with
```
./bin/behat features
```