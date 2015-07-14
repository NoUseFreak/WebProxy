FROM nousefreak/php7:symfony

RUN rm /etc/nginx/sites-enabled/default
ADD config/nginx.vhost.conf /etc/nginx/conf.d/webproxy.conf
ADD config/nginx.offline.conf /etc/nginx/conf.d/offline.conf

EXPOSE 80 443 8080

LABEL webproxy=master
