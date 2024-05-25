FROM php:7.4-cli-alpine

WORKDIR /usr/local/testgeek/

COPY --link ./src ./src

COPY --link ./entrypoint.sh .

RUN chmod +x ./entrypoint.sh

CMD ["/bin/sh", "entrypoint.sh"]