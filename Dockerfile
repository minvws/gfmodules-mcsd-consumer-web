FROM php:8.2-cli

ARG APP_USER="app"
ARG APP_GROUP="app"
ARG NEW_UID
ARG NEW_GID


RUN apt-get update && apt-get install -y wget git unzip wget libzip-dev procps

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -  && \
    apt-get install -y nodejs

RUN groupadd --system ${APP_GROUP} --gid=${NEW_GID} && \
    adduser \
        --disabled-password \
        --gecos "" \
        --uid ${NEW_UID} \
        --gid ${NEW_GID} \
        ${APP_USER}


WORKDIR /app

EXPOSE 8510

RUN chown -R ${APP_USER}:${APP_GROUP} /usr/local

# Somehow packages in this dir are not owned by the app user
RUN chown -R ${APP_USER}:${APP_GROUP} /app

USER ${APP_USER}

# The source files are already copied into the image by using a volume

CMD ["bash", "scripts/entrypoint.sh"]