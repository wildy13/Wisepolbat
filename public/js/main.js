function checkFormBantuan() {
    const formCheckBantuan = document.querySelector('.bantuan .container.kontenBantuan .formPanduan .form-check-input');
    const btnCheckBantuan = document.getElementById('btnCheckBantuan');

    if (formCheckBantuan.checked == true) {
        btnCheckBantuan.style.display = "block";
    } else {
        btnCheckBantuan.style.display = "none";
    }
}

$('.nav-link.item').click(function () {
    $('.navbar-collapse').collapse('hide');
});
