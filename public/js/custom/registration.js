'use strict'
$(document).ready(function() {
        $("#registration_form").validate({
            rules: {
        full_name: {
            required: true,
            minlength: 2
        },
        user_name: {
            required: true,
            minlength: 4
        },
        pin: {
            required: true
        },
        phone: {
            required: true,
            minlength: 9
        },
        password: {
            required: true,
            minlength: 4
        },
        password_confirmation: {
            required: true,
            equalTo: "#password" // Matches the password field by ID
        }
    },
    messages: {
         full_name: {
            required: "Please enter your full name",
            minlength: "Your full name must consist of at least 2 characters"
        },
        user_name: {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 4 characters"
        },
        email: "Please enter a valid email address",
        pin: "Please enter a valid pin",
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Please enter the same password as above"
        }
    }
        });
    });
