#!/bin/bash
echo "Priming opcode cache"

export LAMBDA_TASK_ROOT=$(pwd)
export PHP_INI_SCAN_DIR=$LAMBDA_TASK_ROOT/lib:$LAMBDA_TASK_ROOT/lib/php-7.1.d

mkdir -p $LAMBDA_TASK_ROOT/lib/cache

find -name '*.php' | grep -v random_compat/random_ | xargs -n1 -P4 php \
  -d memory_limit=-1 -d opcache.file_cache_only=0 \
  -r 'echo "."; opcache_compile_file($argv[1]);'

CACHEDIR=$(echo $LAMBDA_TASK_ROOT/lib/cache/*)

chmod -R go+rX $CACHEDIR
mkdir -p $CACHEDIR/var/lib/task
mv $CACHEDIR/codebuild/output/*/src/* $CACHEDIR/var/lib/task/
