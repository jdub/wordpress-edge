FROM bref/php-85:v3

RUN dnf -y install findutils util-linux

CMD [".github/actions/php/opcache.sh"]
ENTRYPOINT ["/bin/bash"]
