FROM php:7.4-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
# COPY ./stone-store.conf /etc/apache2/sites-available/stone-store.conf
RUN apt-get install nano
# RUN echo "ServerName stone-store" >> /etc/apache2/apache2.conf &&\
#     a2enmod rewrite &&\
#     a2enmod headers &&\
#     a2enmod rewrite &&\
#     a2dissite 000-default &&\
#     a2ensite stone-store &&\
#     service apache2 restart
RUN a2enmod rewrite
EXPOSE 80
CMD ["apache2-foreground"]