FROM tutorial-app-dev
# Change current user to www
USER root
RUN apt-get install -y cron
ADD crontab /etc/cron.d/tutorial
RUN chmod 0644 /etc/cron.d/tutorial
RUN crontab /etc/cron.d/tutorial
RUN touch /var/log/cron.log
# Run the command on container startup
CMD cron && tail -f /var/log/cron.log
