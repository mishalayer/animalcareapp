"use strict";

var KTSignupGeneral = function () {
    var form;
    var submitButton;
    var validator;

    var handleForm = function (e) {
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'username': {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-Z0-9ა-ჰ_]+$/,
                                message: 'მომხმარებლის სახელი არ უნდა შეიცავდეს სიმბოლოებს!',
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
                            },
                            callback: {
                                message: 'გთხოვთ შეიყვანოთ ვალიდური პაროლი!',
                                callback: function (input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'პაროლის დადასტურება სავალდებულოა!'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'პაროლები არ ემთხვევა ერთმანეთს!'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    submitButton.disabled = true;

                    setTimeout(function () {
                        submitButton.removeAttribute('data-kt-indicator');

                        submitButton.disabled = false;

                        var username = form.querySelector('[name="username"]').value;
                        var password = form.querySelector('[name="password"]').value;

                        axios.post('animalcareapp/project/register_logic.php', {
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
                                }, 1500);
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
                        });
                    }, 1500);
                } else {
                    Swal.fire({
                        text: "დაფიქსირდა შეცდომა, ბოდიშს გიხდით.",
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

    var validatePassword = function () {
        return true;
    }

    return {
        init: function () {
            form = document.querySelector('#kt_sign_up_form');
            submitButton = document.querySelector('#kt_sign_up_submit');

            handleForm();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});