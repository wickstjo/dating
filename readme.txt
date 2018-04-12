// SITE SET TO WORK UNDER URL http://dating.proj/

   => C:\xampp\apache\conf\extra - httpd-vhosts.conf

      <VirtualHost *:80>
         DocumentRoot "C:/xampp/htdocs"
         ServerName localhost
      </VirtualHost>

      <VirtualHost *:80>
         DocumentRoot "C:/xampp/htdocs/dating"
         ServerName dating.proj
      </VirtualHost>

   => C:\Windows\System32\drivers\etc - hosts

      127.0.0.1 localhost
      127.0.0.1 dating.proj