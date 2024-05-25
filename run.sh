#!/usr/bin/sh
set -x
docker build --tag 'testingg' .
docker run -it --rm --name testing testingg
$SHELL
