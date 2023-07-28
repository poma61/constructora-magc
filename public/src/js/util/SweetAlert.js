class SweetAlert {
    constructor(_propertyes) {
        this._propertyes = _propertyes;
    }

    alert(icon) {
        return Swal.fire({
            title: this._propertyes.title,
            icon: icon,
            text: this._propertyes.text,
            confirmButtonText: this._propertyes.confirmButtonText,
            cancelButtonText: this._propertyes.cancelButtonText,
            showConfirmButton: this._propertyes.showConfirmButton,
            showCancelButton: this._propertyes.showCancelButton,
            showClass: {
                popup:`animate__animated ${this._propertyes.showClass}`
              },
              hideClass: {
                popup: `animate__animated ${this._propertyes.hideClass}`
              },
            allowOutsideClick: () => {
                const popup = Swal.getPopup()
                popup.classList.remove(this._propertyes.showClass)
                setTimeout(() => {
                  popup.classList.add('animate__animated', this._propertyes.persistentClass)
                })
                setTimeout(() => {
                  popup.classList.remove('animate__animated',this._propertyes.persistentClass)
                }, 800)
                return false
              },
        });
    }
    alertToast(icon) {
        return Swal.fire({
            toast: true,
            title: this._propertyes.title,
            icon: icon,
            text: this._propertyes.text,
            showConfirmButton: false,
            showCancelButton: false,
            timer: this._propertyes.timer,
            timerProgressBar: true,
            position: this._propertyes.position,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            customClass: {             
                popup: this._propertyes.popup,
            }
        });
    }


    static success(_propertyes) {
        return new SweetAlert(_propertyes).alert('success');
    }

    static error(_propertyes) {
        return new SweetAlert(_propertyes).alert('error');
    }
    static warning(_propertyes) {
        return new SweetAlert(_propertyes).alert('warning');
    }

    static info(_propertyes) {
        return new SweetAlert(_propertyes).alert('info');
    }
    static question(_propertyes) {
        return new SweetAlert(_propertyes).alert('question');
    }

    static successToast(_propertyes) {
        return new SweetAlert(_propertyes).alertToast('success');
    }

}

export default SweetAlert;