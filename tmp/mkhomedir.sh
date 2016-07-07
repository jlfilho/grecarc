#!/bin/bash
#Script para criar home dir de modo automático pelo grecarc
#criado por João da Mata em 11/02/2015


if [ $# == 2 ]; then
	usuario=$1
	grupo=$2
	
	homedir=/home/$usuario

	if [ ! -d "$homedir" ]; then
		mkdir $homedir
		cp -R /etc/skel/* $homedir
		chown -R $usuario:$grupo $homedir
		service nscd restart
		echo "Diretório $usuario:$grupo $homedir criado com sucesso.  "
 	else
		chown -R $usuario:$grupo $homedir
		service nscd restart
		echo "Diretório $usuario:$grupo $homedir alterado com sucesso."
	fi

else
	echo "Uso: mkhomedir usuario grupo" 
fi
