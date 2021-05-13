# Neilansh Rajpal - Technical Interview for Buzztro
- This repository contains a mini-project done as part of the Technical Interview for Buzztro.com.
- The project exemplifies an e-commerce platform with user and admin panels as per the guidelines.
- Using minimal styling, it mainly focuses on backend development, done using PHP and MySQL for database.
- the XAMPP stack was employed for the same. 

## Main Components
***Two panels used:***
### Admin panel
- Associated files found under the **admin** directory of the repository.
- Supports basic admin functions such as:
  - Sign-in and login.
  - Add, view, update, and delete product.
  - View all customer orders.
- To sign-up, use **adminsignup.html**.
- To login, use **adminlogin.html**.
- **adminHome.php** is the admin homepage and contains links to other php pages supporting different admin functions.
- Admin accounts created: <br/> 
    username: admin123 <br/>
    email: admin@mail.com <br/>
    password: 567 

    username: leomessi <br/>
    email: leo@mail.com <br/>
    password: messi123 

### User panel
- Associated files found under the **user** directory of the repository.
- Supports basic functions such as sign-up, login, view and order products, and view their orders.
- To sign-up, use **signup.html**.
- To login, use **login.html**.
- **userHome.php** is the homepage and contains links to other php pages supporting different user functions.
- User accounts created: <br/>
    firstname: Lebron <br/>
    lastname: James <br/>
    email: kingjames@123.com <br/>
    password: 123

    firstname: dwayne <br/>
    lastname: wade <br/>
    email: wade@123.com <br/>
    password: 345 

    firstname: tony <br/>
    lastname: montana <br/>
    email: montana@mail.com <br/>
    password: tony123

## Classes
*These user-fined classes were implemented:*
- **Database**: PHP class to connect to the database.
- **Admin**: PHP class to support admin functions.
- **User**: PHP class to support user functions.
- **Product**: PHP class to support product functions.
- **Order**: PHP class to support order functions.

## Database
MySQL database was used. The database file **interview_buzztro.sql** could be found in the repository, and should be uploaded to the **phpmyadmin** database.

## Tables
*All the tables contain some entries, which was done through the backend scripts.***
- **admin** table containing admin info.
- **user** table containing user info.
- **products** table containing product info.
- **order** table containing order info.

## Miscellaneous:
- **product_images** directory to store images of product after their uploaded to be added to the database.

## Issues:
- The product images don't load after retrieval from the database. **base64** encrypting was used for the same as images were stored in **BLOB** format. 
- Session management in some files may be faulty.








