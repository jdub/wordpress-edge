#!/bin/bash
CACHE=zero/opcache
mkdir -p ${CACHE}
find vendor wordpress -name '*.php' -type f | xargs -n1 -P$(nproc) php -n \
  -d "memory_limit=-1" \
  -d "zend_extension=opcache" \
  -d "opcache.enable_cli=1" \
  -d "opcache.jit=function" \
  -d "opcache.file_cache=$(pwd)/${CACHE}" \
  -d "opcache.file_cache_only=1" \
  -r 'echo "."; opcache_compile_file($argv[1]);'
