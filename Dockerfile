FROM webdevops/php-nginx:8.0-alpine

# Install Laravel framework system requirements (https://laravel.com/docs/8.x/deployment#optimizing-configuration-loading)
RUN apk add oniguruma-dev postgresql-dev libxml2-dev
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        mbstring \
        pdo_mysql \
        pdo_pgsql \
        tokenizer \
        xml

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT=/app/public \
    APP_ENV=production \
    APP_NAME=Laravel \
    APP_ENV=production \
    APP_DEBUG="false" \
    APP_URL=http://localhost \
    APP_TIMEZONE=Asia/Jakarta \
    LOG_CHANNEL=stack \
    LOG_SLACK_WEBHOOK_URL= \
    DB_CONNECTION=mysql \
    DB_HOST=db \
    DB_PORT=3306 \
    DB_DATABASE=crud \
    DB_USERNAME=admin \
    DB_PASSWORD=qwerty \
    CACHE_DRIVER=file \
    QUEUE_CONNECTION=sync \
    JWT_SECRET=ini_rahasia

WORKDIR /app
COPY . .
#RUN source .env.staging

# run composer install
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN chown -R application:application .
