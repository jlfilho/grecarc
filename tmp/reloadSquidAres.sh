#!/bin/bash
scp /home/grecarc/public_html/tmp/mac_alunos.txt root@ares.icet.ufam.edu.br:/etc/squid3/list/mac_alunos.txt
ssh root@ares.icet.ufam.edu.br '/etc/init.d/squid3 reload' 



