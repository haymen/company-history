ARG VERSION
FROM nginx:${VERSION}-alpine  as builder

ARG VERSION
ARG TIMEZONE

ARG APP_CODE_PATH=/var/www
ARG NGINX_ROOT=/var/www/public
ARG VIRTUAL_HOST=localhost
ARG PHP_UPSTREAM

WORKDIR ${APP_CODE_PATH}

RUN apk add --update --no-cache tzdata \
  && ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
  && echo ${TIMEZONE} > /etc/timezone \
  && rm /etc/nginx/conf.d/default.conf \
  && ln -sf /dev/stdout /var/log/nginx/access.log \
  && ln -sf /dev/stderr /var/log/nginx/error.log


COPY nginx/config/ /etc/nginx/

RUN sed -i "s#__VIRTUAL_HOST#${VIRTUAL_HOST}#g" /etc/nginx/conf.d/default.conf \
  && sed -i "s#__PHP_UPSTREAM#${PHP_UPSTREAM}#g" /etc/nginx/conf.d/default.conf \
  && sed -i "s#__NGINX_ROOT#${NGINX_ROOT}#g" /etc/nginx/conf.d/default.conf

# ----------------------------------------------------------------------------
#  DEV TARGET
# ----------------------------------------------------------------------------

FROM builder as dev

EXPOSE 80