FROM bref/php-84:2.3.38

RUN php composer.phar install --no-dev

CMD ["ci/opcache.sh"]
ENTRYPOINT ["bash"]
