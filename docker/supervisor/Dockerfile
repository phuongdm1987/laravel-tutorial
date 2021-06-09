FROM tutorial-app-dev

# Change current user to www
USER root

RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    supervisor

COPY supervisord.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]

WORKDIR /etc/supervisor/conf.d/
