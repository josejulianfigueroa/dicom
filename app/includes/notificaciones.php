<?php

  function mensaje_bienvenida()
  {
return '<script>
		Push.create("Bienvenido",{
			body: "Hola '.Session::get('nombre').', es un placer saludarte",
			icon: "'.asset('imgs/logo.png').'",
		    timeout: 5000,
			onClick: function () {
				//window.location="https://nickersoft.github.io/push.js/";
				this.close();
			}
		});
	</script>';
  }

    function notificacion_termino_campania()
  {
return '<script>
		Push.create("Bienvenido",{
			body: "Hola '.Session::get('nombre').', como estas?",
			icon: "'.asset('imgs/logo.png').'",
			onClick: function () {
				//window.location="https://nickersoft.github.io/push.js/";
				this.close();
			}
		});
	</script>';
  }


  ?>