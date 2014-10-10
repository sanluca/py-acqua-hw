#!/bin/sh
### BEGIN INIT INFO
# Provides:          pyacqua
# Required-Start:    
# Required-Stop:
# Should-Start:      
# Default-Start:     2 3
# Default-Stop:      0 1 6 
# Short-Description: pyacqua.
# Description:       pyacqua.
### END INIT INFO

case $1 in 
  start)
   /media/data/py-acqua-hw/py/main.py start
  ;;
  stop)
   kill -9 $(cat /var/run/pyacqua.pid)
  ;;
esac
