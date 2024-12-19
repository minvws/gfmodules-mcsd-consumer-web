FROM php:8.2-cli

ARG APP_USER="app"
ARG APP_GROUP="app"
ARG NEW_UID
ARG NEW_GID



RUN apt-get update && apt-get install -y wget git unzip wget libzip-dev procps

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install the Symphony CLI
RUN wget https://github.com/symfony-cli/symfony-cli/releases/download/v5.8.15/symfony-cli_linux_amd64.tar.gz
RUN tar -xvzf symfony-cli_linux_amd64.tar.gz
RUN mv symfony /usr/local/bin/symfony

RUN groupadd --system ${APP_GROUP} --gid=${NEW_GID} && \
    adduser \
        --disabled-password \
        --gecos "" \
        --uid ${NEW_UID} \
        --gid ${NEW_GID} \
        ${APP_USER}

USER ${APP_USER}

# The source files are already copied into the image by using a volume
WORKDIR /app

CMD ["bash", "scripts/entrypoint.sh"]