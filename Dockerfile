FROM quay.io/vesica/php73:latest

# Copy files
RUN cd ../ && rm -rf /var/www/html
COPY . /var/www/
COPY etc/apache2/mods-enabled/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

# Run Composer
RUN cd /var/www && composer install --no-dev

# Delete stuff we do not need
RUN rm -rf /var/www/db
RUN rm -rf /var/www/.git
RUN rm -rf /var/www/.gitignore
RUN rm -rf /var/www/build.sh
RUN rm -rf /var/www/.idea

RUN chown -R www-data:www-data /var/www/

VOLUME /var/www/storage

ENV LOAD_BALANCER_MODE "0"
ENV LOAD_BALANCER_KEY "KEY"
