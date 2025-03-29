# Informatika Rendszer és Alkalmazás Üzemeltető Technikus Projektmunka
![link](umszkikresz/SmallSquareLogoJpg.ico)
## LINUX
### WEBOLDAL(AK)
1. [BEMUTATÓ](https://tmsblnt.hu/vizsgaremek/)
1. [UMSZKI KRESZ](https://tmsblnt.hu/umszkikresz/)
1. [UMSZKI KRESZ DASHBOARD](https://tmsblnt.hu/dashboard/login.php) 

#### HTTPS Támogatással
```console
root@blnt:~# apt update
root@blnt:~# apt install certbot python3-certbot-apache
root@blnt:~# certbot --apache
root@blnt:~# systemctl reload apache2
root@blnt:~# certbot renew --dry-run
```
### FILESERVER
#### WebDav
```console
root@pi:~# a2enmod dav
root@pi:~# a2enmod dav_fs 
root@pi:~# a2enmod dav_lock
root@pi:~# a2enmod auth_digest
root@pi:~# service apache2 restart
root@pi:~# mkdir -p /var/www/webdav
root@pi:~# chown www-data:www-data /var/www/webdav
root@pi:~# mkdir -p /usr/local/apache/var/
root@pi:~# chown www-data:www-data /usr/local/apache/var
```
#### Samba
```console
root@pi:~# apt install samba
nano /etc/samba/smb.conf
[megoszt] 
path = /var/www/webdav
 browseable = yes
 writeable = yes
 guest ok = yes
 create mask = 0777
 directory mask = 0777
 public = yes
service smbd restart
```
## Windows
### TODO

## Packet Tracer
### TODO