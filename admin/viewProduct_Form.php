<?php
session_start();
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're looking for</h2>";
    }
    else{
        echo "<!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Add product</title>
            
                <script type=\"text/javascript\">
                    window.onload = function(){
                        var form = document.getElementById('view_product');
                        form.onsubmit = function(e){
                            checkFields(event);
                            //alert('hi');
                        }
                    }
            
                    // function to check fields and validate uploaded image formats
                    function checkFields(event){
                        var p_id = document.getElementById('p_id');
                        var p_name = document.getElementById('p_name');   
                    
                        // creating an array of required fields to check field validity
                        var required_fields = [p_id, p_name];
                        for(var i = 0; i < required_fields.length; i++){
                            if(required_fields[i].value.length == 0){  // if a field is empty
                                alert('One or more fields are empty');
                                event.preventDefault();               
                            }        
                        }
                    }
                </script>
            </head>
            <body>
                <form id=\"view_product\" action=\"viewProduct.php\" method=\"POST\" enctype=\"multipart/form-data\" style=\"text-align: center\";>
                        <h1>View product</h1>
            
                        <div style=\"margin: 10px\">
                            <input type=\"text\" id=\"p_id\" name=\"p_id\" placeholder=\"Product ID\"><br>
                        </div>
            
                        <div style=\"margin: 10px\">
                            <input type=\"text\" id=\"p_name\" name=\"p_name\" placeholder=\"Product name\"><br>
                        </div>
            
                        <div style=\"text-align: center;\">
                            <input  type=\"submit\" value=\"View product\">
                        </div>
                </form>
            
                <div style=\"text-align: center; font-size: 20px\">
                    <p> <a href=\"./adminHome.php\">Back to home</a> </p>
                </div>       
            </body>
            </html>";
    }  

?>

