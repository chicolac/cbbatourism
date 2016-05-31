/*****************************************************************************
			Presentación de Imágenes (SlideShow) por Tunait!
			Si quieres usar este script en tu sitio eres libre de hacerlo con la condición de que permanezcan intactas estas líneas, osea, los créditos.
			Actualizado el 28/12/2003 - 10/2011

			http://javascript.tunait.com
			tunait@yahoo.com 
			
			http://es.wikipedia.org/wiki/JSON
			******************************************************************************/
			var segundos = 4; //cada cuantos segundos cambia la imagen
			var dire = "img/viva"; //directorio o ruta donde están las imágenes

			var imagenes = new Array()
			imagenes[0]="<?php echo $this->basePath('img/viva/foto01.jpg') ?>"
			imagenes[1]="<?php echo $this->basePath('img/viva/foto02.jpg') ?>"
			imagenes[2]="<?php echo $this->basePath('img/viva/foto03.jpg') ?>"
			imagenes[3]="<?php echo $this->basePath('img/viva/foto04.jpg') ?>"
			
			if(dire != "" && dire.charAt(dire.length-1) != "/")
			{
			    dire = dire + "/"
			}

			var preImagenes = new Array()
			
			for (pre = 0; pre < imagenes.length; pre++){
				preImagenes[pre] = new Image();
				preImagenes[pre].src = dire + imagenes[pre];
			}
			
			cont=0
			function presImagen(){
				document.img_central.src= dire + imagenes[cont];
				subeOpacidad();
				if (cont < imagenes.length-1)
					{cont ++}
				else
					{cont=0}
				tiempo=window.setTimeout('bajaOpacidad()',segundos*1000);
			}
			
			// página 158 javascript step by step
			var iex = navigator.appName=="Microsoft Internet Explorer" ? true : false;
			var fi = iex ? 'filters.alpha.opacity':'style.opacity';
			var opa = iex ? 100 : 1;
			
			function bajaOpacidad(){
				eval(opa);
				if(opa >= 0){
					cambia();
					opa -= iex?50:0.1;
					setTimeout('bajaOpacidad()',50);
				}
				else{presImagen()}
			}

			function subeOpacidad(){
				opaci = iex?100:1;
				if(opa <= opaci){
					cambia();
					opa += iex?10: 0.1;
					setTimeout('subeOpacidad()',10);
				}
			}
			
			function cambia(){
				eval('document.img_central.' + fi + ' = opa')
			}
			
			var tiempo;
			
			function inicio(){
				clearTimeout(tiempo);
				bajaOpacidad();
				$(document).foundation();
			}
