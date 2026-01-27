FROM bref/php-84:2.3.38

RUN ln -s /actions/workspace /opt/zero

# CMD ["composer.phar", "install", "--no-dev"]
# ENTRYPOINT ["php"]
ENTRYPOINT ["/bin/ls", "-lh", "/opt/zero/"]
