"use strict";

var KTSigninGeneral = function () {
    var form;
    var submitButton;
    var validator;

    var handleValidation = function (e) {
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'username': {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-Z0-9]+$/,
                                message: 'მომხმარებლის სახელი არ უნდა შეიცავდეს სიმბოლოებს',
                            },
                            notEmpty: {
                                message: 'მომხმარებლის სახელი სავალდებულოა!'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'პაროლის შეყვანა სავალდებულოა!'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
    }

    var handleSubmitAjax = function (e) {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    var username = form.querySelector('[name="username"]').value;
                    var password = form.querySelector('[name="password"]').value;
                    axios.post('nmgp/project/sign_in_logic.php', {
                        username: username,
                        password: password
                    }).then(function (response) {
                        if (response.data.status === 'success') {
                            Swal.fire({
                                text: response.data.message,
                                icon: "success",
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "d-none"
                                }
                            });
                            setTimeout(function () {
                                window.location.href = response.data.redirect;
                            }, 1000);
                        } else {
                            Swal.fire({
                                text: response.data.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "ფანჯრის დახურვა",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }).catch(function (error) {
                        console.error("AJAX request failed", error);
                    }).finally(function () {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    });
                } else {
                    Swal.fire({
                        text: "დაფიქსირდა შეცდომა, გთხოვთ ხელახლა ცადოთ!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "ფანჯრის დახურვა",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    }
    return {
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleValidation();
            handleSubmitAjax();
        }
    };
}();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});