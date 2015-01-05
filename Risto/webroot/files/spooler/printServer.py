#!/usr/bin/env python 
""" 
Servidor de impresion a archivos
Necesita tener instalado el paquete python-daemon

para agregar la impresora a cups hacer:
sudo lpadmin -p [NOMBRE] -E -v socket://localhost:[PUERTO] -m raw

para que CUPS imprima rapido via sockets hay que settear lo siguiente (waiteof=false):
socket://uri:port?waiteof=false

(el puerto debe coincidir con alguno de la configuracion de puerto-archivo que esta mas abajo)

la carpeta, en este caso /tmp/fuente, es la que el spooler estara leyendo
"""

import glob, re, os, subprocess, socket, select, daemon, shutil, time, logging
from tempfile import NamedTemporaryFile

#CONFIGURACION DE PUERTOS-ARCHIVOS
opts = [	
	{"port":12001, "suffix":".txt", "prefix":"fiscal_", "dir":"/tmp/fuente/"}
]
sockets = {}

#Nombre del dispositivo segun /dev. Ej: ttyUEB0, o fiscalprinter si se esta usando UDEV
dev_name = "fiscalprinter"


def daemon_main():
        logging.basicConfig(filename='/tmp/ristoPytonlogin.log', level=logging.INFO)
        logging.info( "adentro del SERVICIO")
	while 1:
		inputready,outputready,exceptready = select.select(sockets.keys(),[],[])
		for s in inputready:
			conn, addr = s.accept()
			f = NamedTemporaryFile(suffix=sockets[s]["suffix"], prefix=sockets[s]["prefix"], delete=False)
			name = f.name
			while 1:
				data = conn.recv(1024)
				if not data: 
					break
				f.write(data)
			conn.close()
			f.close()
                        os.chmod(name, 0o664)
			logging.info( "nuevo archivo: "+name)
			salida = subprocess.call("spooler -p"+dev_name+" -f "+name, shell=True)
			logging.info(salida)
			shutil.copy(name, sockets[s]["dir"])

def main():
        print "iniciando"
	for opt in opts:
		if not os.path.exists(opt["dir"]):	
			os.makedirs(opt["dir"])
			os.chmod(opt["dir"], 0o777)
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s.bind(('', opt["port"]))
		s.listen(1)
		sockets[s] = opt

	files = [s.fileno() for s in sockets.keys()]
	context = daemon.DaemonContext(files_preserve = files)
	print files
	with context:
		daemon_main()

if __name__ == "__main__":
	main()
