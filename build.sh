#!/bin/bash
set -e
docker build --platform linux/amd64 . -t ghcr.io/haha1903/wx-jyy:latest --no-cache --pull
docker push ghcr.io/haha1903/wx-jyy:latest
