#Fruit Salad
*Tagline goes here*

##Introduction

##Setup
###Backend
####Set up internet forwarding
Run these commands to set up internet forwarding:

    iptables -A FORWARD -i eth0 -o wlan0 -s 192.168.137.1/24 -m conntrack --ctstate NEW -j ACCEPT
    iptables -A FORWARD -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT
    iptables -A POSTROUTING -t nat -j MASQUERADE
    echo 1 > /proc/sys/net/ipv4/ip_forward

####Setup a LAMP stack 
*apt-get command goess here!*

####Basket - MySQL Server
Run the basket.sql SQL setup script located misc

####Cron Job
Run crontab crontab.txt in the root folder. Note that if "check_status.php" is not located in /var/www/ then the absolute path in the "crontab.txt" file will need to be updated. The user that runs the cron job will also need to have permissions to run "iptables". Permission can be added by adding "YOUR_USERNAME ALL=NOPASSWD: /sbin/iptables" (without the quotes) to the sudoer file (open with "sudo visudo").

##Usage
*Fill this out*
