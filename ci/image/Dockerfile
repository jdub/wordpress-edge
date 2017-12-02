# http://docs.aws.amazon.com/lambda/latest/dg/current-supported-versions.html
FROM amazonlinux:2017.03

# Node and Yarn package repositories
RUN curl --silent --location https://rpm.nodesource.com/setup_6.x | bash -
RUN curl --silent --location https://dl.yarnpkg.com/rpm/yarn.repo --output /etc/yum.repos.d/yarn.repo

# Lambda uses 2017.03's original openssl 1.0.1k, so we avoid updates
RUN rm /etc/yum.repos.d/amzn-{preview,updates}.repo

# Install packages
RUN yum install --assumeyes \
  findutils \
  yarn \
  php71-cli php71-mysqlnd php71-gd php71-opcache
