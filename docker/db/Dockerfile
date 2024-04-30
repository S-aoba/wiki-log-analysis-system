FROM mysql:latest

RUN microdnf install yum \
  && yum install -y glibc-langpack-ja glibc-locale-source git

ENV LANG ja\_JP.UTF-8
