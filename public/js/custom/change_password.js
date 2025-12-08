'use strict'
$(document).ready(function() {
        $("#change_password").validate({
            rules: {
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
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 4 characters long"
        },
        password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Please enter the same password as above"
        }
    }
        });
    });
