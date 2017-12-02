#!/bin/bash

# Copy PHP configuration files
#cp /etc/php-7.1.ini $CODEBUILD_SRC_DIR/lib/php.ini
cp -r /etc/php-7.1.d $CODEBUILD_SRC_DIR/lib/php-7.1.d

# Copy PHP binaries
cp /usr/bin/php-cgi-7.1 $CODEBUILD_SRC_DIR/lib/php-cgi
cp -r /usr/lib64/php/7.1/modules $CODEBUILD_SRC_DIR/lib/modules

# Copy shared libraries required by PHP
cp -L \
  /usr/lib64/libedit.so.0 \
  /usr/lib64/libXpm.so.4 \
  $CODEBUILD_SRC_DIR/lib/

# Copy shared libraries required by PHP via strace discovery
# cp -L $(strace -e trace=open -qo /dev/stdout /usr/bin/php-7.1 -r 'exit(0);' \
#   | grep '/usr/lib64.*\.so\.' \
#   | egrep -v 'k5|krb|libicu|libselinux|libstd' \
#   | cut -d'"' -f2) $CODEBUILD_SRC_DIR/lib/
