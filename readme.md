#Fruit Salad
*Tagline goes here*

##Introduction

##Setup
Run "git checkout https://github.com/alivira/FruitSalad.git" (without quotes) somewhere, then recursively copy the files to /var/www. Dont forget to copy hidden files.

###Backend
####Set up internet forwarding
Run these commands to set up internet forwarding:

    iptables -A FORWARD -i eth0 -o wlan0 -s 192.168.137.1/24 -m conntrack --ctstate NEW -j ACCEPT
    iptables -A FORWARD -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT
    iptables -A POSTROUTING -t nat -j MASQUERADE
    echo 1 > /proc/sys/net/ipv4/ip_forward

####Setup a LAMP stack 
*apt-get command goess here!*

Add the following to the bottom of your /etc/apache2/apache2.conf file:
    <VirtualHost _default_:*>
        DocumentRoot /var/www
    </VirtualHost>

    Include /etc/phpmyadmin/apache.conf


####Basket - MySQL Server
Make a database called basket
Import the basket.sql SQL setup script located in misc into the basket database

####Cron Job
Run crontab crontab.txt in the root folder. Note that if "check_status.php" is not located in /var/www/ then the absolute path in the "crontab.txt" file will need to be updated. The user that runs the cron job will also need to have permissions to run "iptables". Permission can be added by adding "YOUR_USERNAME ALL=NOPASSWD: /sbin/iptables" (without the quotes) to the sudoer file (open with "sudo visudo").

##Usage
*Fill this out*
