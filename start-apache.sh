#!/bin/bash
echo "ServerName localhost" >> /etc/apache2/apache2.conf
apache2-foreground
