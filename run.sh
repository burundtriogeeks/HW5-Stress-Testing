#!/bin/bash

docker run -it --rm -v $(pwd):/app ecliptik/docker-siege --concurrent=$1 -b -i -t30s -f /app/etc/siege/urls.txt