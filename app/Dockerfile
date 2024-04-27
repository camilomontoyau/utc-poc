FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive

# install curl and git
RUN apt-get update && apt-get install -y curl git

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs


RUN apt-get update && \
  apt-get install -y apache2 php7.4 php7.4-mysql php7.4-curl php7.4-gd php7.4-xml php7.4-mbstring libapache2-mod-php7.4 && \
  apt-get install -y default-mysql-client && \
  apt-get install -y iputils-ping && \     
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt install zip unzip php-zip -y
RUN apt install cron -y && apt install nano -y

RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# start apache
CMD /usr/sbin/apache2ctl -D FOREGROUND
