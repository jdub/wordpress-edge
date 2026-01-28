#!/bin/bash
set -euo pipefail

mkdir -p /opt/zero/opcache
find /opt/zero -name '*.php' -type f | xargs -n1 -P$(nproc) /opt/bin/php \
  -d 'memory_limit=-1' \
  -d 'opcache.enable_cli=true' \
  -d 'opcache.jit=function' \
  -d 'opcache.file_cache=/opt/zero/opcache' \
  -d 'opcache.file_cache_only=true' \
  -r 'opcache_compile_file($argv[1]);'

# fix opcache permissions
chmod -R go+rX /opt/zero/opcache
