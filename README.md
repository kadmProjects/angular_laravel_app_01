# angular_laravel_app_01
Angular Laravel REST api with Passport using **http only cookie** based Authentication.

# To setup the project
1. Clone the repository.
2. Create a new directory(**myApi**) and inside that create a new directory called **api**.
3. Move all the contents within backend directory.
4. Run production build for frontend.
5. Move all the contents within dist/angular_laravel_app_01 into **myApi** directory along with the **.htaccess** file.
6. Create a virtualHost using apache (Root directory should be **myApi**) and run the application.
8. Change the laravel **.env** file **SESSION-DOMAIN** and angular **environment.ts** file for match with your virtualhost.
7. Folder Structure.
   ![image](https://user-images.githubusercontent.com/40564817/75652470-22a50c80-5c81-11ea-95ff-42fbc70f4d56.png)

