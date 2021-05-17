<?php
    session_start();
    include('../header.php');
    if(!isset($_SESSION['userType']) || ($_SESSION['userType'] == 2)){  // if a user/guest tries to access this page
        echo "<h2>Error 404: Could not find the page you're looking for</h2>";
    }
    else{
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>View Products</title>
        
            <script>
                window.onload = function(){
                    var search_form = document.getElementById('search_product');
                    var searchBy = document.getElementById('searchBy');
                    var filter = document.getElementById('filter');
        
                    searchBy.onchange = function(){
                        if(searchBy.value == 'id'){
                            filter.placeholder = 'Search by Product ID';
                            search_form.action = 'viewProduct.php?filterBy=p_id';
                        }
                        else if(searchBy.value == 'name'){
                            filter.placeholder = 'Search by Name';
                            search_form.action = 'viewProduct.php?filterBy=name';
                        }
                        else{
                            filter.placeholder = 'Search by Category';
                            search_form.action = 'viewProduct.php?filterBy=category';
                        }
                    }
        
                }
        
            </script>
        </head>
        <body>
            <div style='margin: 10px'>
                <button onclick='document.location=\"adminHome.php\"'>Back</button>
            </div>
            <form id='search_product' action='viewProduct.php?filterBy=p_id' method='POST' enctype='multipart/form-data' style='text-align: center'>
        
                <label>Search by:</label>
                <select id='searchBy'>
                  <option value='id' selected>id</option>
                  <option value='name'>name</option>
                  <option value='category'>category</option>

                </select>
        
                <div style='margin: 10px'>
                    <input type='text' id='filter' name='filterValue' placeholder='Search by Product ID'>
                    <input class='buttons' type='submit' value='Search'>
                </div>
        
            </form>
        </body>
        </html>";
    }  

?>

