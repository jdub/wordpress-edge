#!/bin/bash
ln -v -s /github/workspace /opt/zero
mkdir -p /opt/zero/opcache

php composer.phar install --no-dev

find /opt/zero/vendor /opt/zero/wordpress -name '*.php' -type f | xargs -n1 -P$(nproc) php \
  -d "memory_limit=-1" \
  -d "opcache.enable_cli=true" \
  -d "opcache.jit=function" \
  -d "opcache.file_cache=/opt/zero/opcache" \
  -d "opcache.file_cache_only=true" \
  -r 'echo "."; opcache_compile_file($argv[1]);'

chmod -R go+rX /opt/zero/opcache
