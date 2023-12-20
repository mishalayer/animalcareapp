"use strict";

// Class definition
var KTSignupGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules.
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

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function () {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Get form data
                        var username = form.querySelector('[name="username"]').value;
                        var password = form.querySelector('[name="password"]').value;

                        // Send data to the server
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
                                // Registration failed
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
                    // Show error popup
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

    // Password input validation
    var validatePassword = function () {
        return true;  // You can add your password validation logic here if needed
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            // Elements
            form = document.querySelector('#kt_sign_up_form');
            submitButton = document.querySelector('#kt_sign_up_submit');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});