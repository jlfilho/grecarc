#!/bin/bash
scp /home/grecarc/public_html/tmp/mac_professores.txt root@10.0.0.1:/etc/squid3/list/mac_professores.txt
scp /home/grecarc/public_html/tmp/mac_tecnicos.txt root@10.0.0.1:/etc/squid3/list/mac_tecnicos.txt
scp /home/grecarc/public_html/tmp/mac_visitantes.txt root@10.0.0.1:/etc/squid3/list/mac_visitantes.txt
scp /home/grecarc/public_html/tmp/mac_posgraduando.txt root@10.0.0.1:/etc/squid3/list/mac_posgraduando.txt
ssh root@10.0.0.1 '/etc/init.d/squid3 reload' 



