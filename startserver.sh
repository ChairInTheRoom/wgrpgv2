#!/bin/sh
cd /opt/lampp
./lampp startapache && ./lampp startmysql
tail -f /dev/null
