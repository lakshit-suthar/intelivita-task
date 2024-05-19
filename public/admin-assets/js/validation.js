$(document).ready(function() {
    $('#userForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "Please enter a name",
                minlength: "Name must be at least 3 characters long",
                maxlength: "Name must not exceed 255 characters"
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 6 characters long"
            },
            password_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            }
        }
    });
});


$(document).ready(function () {
    // Add answer dynamically
    $('#add-answer').click(function () {
        var index = $('#answers-section').find('input[type="text"]').length;
        $('#answers-section').append(`
            <div class="mt-2">
                <div class="flex items-center">
                    <input type="text" name="answers[${index}][answer_text]" class="form-input rounded-md shadow-sm w-full" placeholder="Answer text" required>
                    <input type="checkbox" name="answers[${index}][is_correct]" value="1" class="ml-2"> Correct
                </div>
            </div>
        `);
    });

    // jQuery Validation
    $('#question-form').validate({
        rules: {
            question_text: {
                required: true,
                minlength: 5
            },
            time_limit: {
                required: true,
                min: 1
            },
            'answers[][answer_text]': {
                required: true
            }
        },
        messages: {
            question_text: {
                required: "Please enter a question text",
                minlength: "Question text must be at least 5 characters long"
            },
            time_limit: {
                required: "Please enter a time limit",
                min: "Time limit must be at least 1 second"
            },
            'answers[][answer_text]': {
                required: "Please enter answer text"
            }
        },
        errorClass: 'text-red-500',
        errorElement: 'span',
        submitHandler: function (form) {
            form.submit();
        }
    });
});