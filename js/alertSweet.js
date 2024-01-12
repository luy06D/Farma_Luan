function mostrarSweetAlert(title, icon, text, timer = 1500) {

    Swal.fire({
      title: title,
      icon: icon,
      text: text,
      showConfirmButton: false,
      timer: timer
    });
  }


    /**
     * @param {String} titulo Texto que se muestra con fuente ampliada
     * @param {String} mensaje Contenido detallando la notificación
     * */
    function mostrarPregunta(titulo, mensaje) {
      return Swal.fire({
          title: titulo,
          text: mensaje,
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#007bff',
          cancelButtonColor: '#797D7F',
          footer: 'Farma Luan'
        }).then((result) => {
          return result;
      });
    }

    // Mensaje de complete los campos faltantes
    function completeCampos(){
      Swal.fire({
        title: "Por favor, complete los campos",
        icon: "warning",
        confirmButtonColor: "#E43D2C",
    });

    }

    function stockInsuficiente(){
      Swal.fire({
        title: "Stock insuficiente",
        icon: "warning",
        confirmButtonColor: "#E43D2C",
    });

    }
    
    // ERROR registrado
    function errorRegistrado(titulo){
      Swal.fire({
        title: titulo,
        icon: "warning",
        confirmButtonColor: "#E43D2C",
    });

    }

    //Mostrar mensaje Eliminar
    function mostrarPreguntaEliminar() {
      return Swal.fire({
        title: '¿Está seguro de eliminar el registro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        footer: 'Farma Luan'
      }).then((result) => {
          return result;
      });
    }

    //Mostrar mensaje Eliminar
    function mostrarPreguntaDesactivar() {
      return Swal.fire({
        title: '¿Se eliminara este producto de la lista?',
        text: "Confirmar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        footer: 'Farma Luan'
      }).then((result) => {
          return result;
      });
    }

    //Mostrar mensaje Activar

    function mostrarPreguntaActivar() {
      return Swal.fire({
        title: '¿Está seguro de activar el registro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar',
        footer: 'Farma Luan'
      }).then((result) => {
          return result;
      });
    }


    // Toast finalizar contrato
    function toastFinalizar(mensaje){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: mensaje
      })
    }


