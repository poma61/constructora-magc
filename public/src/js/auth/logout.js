import config from "/src/js/config.js"
$('#salir').click(function () {
  Swal.fire({
    icon: 'question',
    title: '¿Esta seguro  de salir del sistema?',
    showCancelButton: true,
    confirmButtonText: 'Salir',
    cancelButtonText: 'Cancelar',
    showClass: {
      popup: 'animate__animated animate__flipInY'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutY'
    },
    allowOutsideClick: () => {
      const popup = Swal.getPopup()
      popup.classList.remove('animate__flipInY')
      setTimeout(() => {
        popup.classList.add('animate__animated', 'animate__headShake')
      })
      setTimeout(() => {
        popup.classList.remove('animate__animated', 'animate__headShake')
      }, 500)
      return false
    },
 
    customClass: {
      confirmButton: 'button is-info m-1 is-active',
      cancelButton: 'button is-danger m-1 is-active'
    },
   
  }).then((result) => {
    if (result.isConfirmed) {
      setTimeout(()=>{
        window.location.replace(config.BASE_URL+"/salir");
      },500);
   
    }

  })

});
