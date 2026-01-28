#!/bin/bash
set -euo pipefail

php composer.phar install --no-dev

mkdir -p /opt/zero
mount -o bind $(pwd) /opt/zero

mkdir -p /opt/zero/opcache
find vendor wordpress -name '*.php' -type f | xargs -n1 -P$(nproc) php \
  -d "memory_limit=-1" \
  -d "opcache.enable_cli=true" \
  -d "opcache.jit=function" \
  -d "opcache.file_cache=/opt/zero/opcache" \
  -d "opcache.file_cache_only=true" \
  -r 'echo "."; opcache_compile_file($argv[1]);'

# fix opcache permissions
chmod -R go+rX /opt/zero/opcache
