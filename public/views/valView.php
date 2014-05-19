<script type="text/javascript">
    $().ready(function() {
        // Generate a form
        var form = $("#myform");

        form.dform({
            "html" :
                [
                    {
                        "type" : "p",
                        "html" : "You must login"
                    },
                    {
                        "name" : "username",
                        "id" : "txt-username",
                        "caption" : "Username",
                        "type" : "text",
                        "placeholder" : "E.g. user@example.com"
                    },
                    {
                        "type" : "br"
                    },
                    {
                        "name" : "name",
                        "id" : "name",
                        "caption" : "First Name",
                        "type" : "text"
                    },
                    {
                        "type" : "br"
                    },
                    {
                        "name" : "password",
                        "caption" : "Password",
                        "type" : "password"
                    },
                    {
                        "type" : "br"
                    },
                    {
                        "type" : "submit",
                        "value" : "Login"
                    }
                ]
        });

        form.validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2
                },
                name: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 5
                }
            },
            submitHandler: function() {
                var data = form.serialize();

                $.ajax({
                    url: "http://localhost:8088/mvc_cms/dataUpload",
                    type: "POST",
                    data: data,
                    success: function(data, textStatus, jqXHR){
                        console.log(data);
                        $("#myform").animate({
                            opacity: 0.25,
                            left: "+=50",
                            height: "toggle"
                        }, 1000, function() {

                        });

                        var div = document.getElementById('msg');
                        var p_msg = document.createElement('p');
                        p_msg.id = 'p_msg';
                        p_msg.textContent = "thanks you!";

                        div.appendChild(p_msg);
                    }
                });
            }
        });
    });
</script>
<form id="myform"></form>
<div id="msg"></div>