FROM bref/php-85:v3

RUN dnf -y install findutils

CMD [".github/actions/php/opcache.sh"]
ENTRYPOINT ["/bin/bash"]
