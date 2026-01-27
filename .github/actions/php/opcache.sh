#!/bin/bash
mkdir -p opcache
ln -v -s /github/workspace /opt/zero
find /opt/zero/vendor /opt/zero/wordpress -name '*.php' -type f | xargs -n1 -P$(nproc) php \
  -d "memory_limit=-1" \
  -d "opcache.enable_cli=1" \
  -d "opcache.jit=function" \
  -d "opcache.file_cache=/opt/zero/opcache" \
  -d "opcache.file_cache_only=1" \
  -r 'echo "."; opcache_compile_file($argv[1]);'
