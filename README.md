# Coding Test Project Setup

### To setup this project successfully, you need

- **[Composer For PHP Dependencies](https://getcomposer.org/)**
- **[PHP 8.1 Minimun requirement for Laravel 10](https://www.apachefriends.org/download.html)**
- **[MYSQL For Managing the database](https://www.apachefriends.org/download.html/)**
- **[NodeJS for installing VueJS dependencies](https://nodejs.org/en/)**




## 1. Clone the Project Repository

- ### Clone the project Repository by Running this command in a folder you have created.


![Cloning the Project](/installation_files/coding_test_1.PNG "Cloning the Project").

## 2. Install Dependencies

- ### Once the project has been cloned, cd into the project and run.

```
composer install 
```

![Cloning the Project](/installation_files/coding_test_2.PNG "Cloning the Project").


## 3. Configure Database and Set up the Project

- Rename .env-example to .env
- Add database details to the .env ( Make sure to create the database or you can create it during migration ).
- Run the following command to create the database and migrate the desired tables.
  
  ```
  php artisan migrate
  ```
- Run the following command to clear cache, run migrations,run database seeders and factories.

```
php artisan setup:dev 
```

![Cloning the Project](/installation_files/coding_test_3.PNG "Cloning the Project").
![Cloning the Project](/installation_files/coding_test_4.PNG "Cloning the Project").
![Cloning the Project](/installation_files/coding_test_5.PNG "Cloning the Project").
![Cloning the Project](/installation_files/coding_test_6.PNG "Cloning the Project").


## 4. Start Backend Server
- Start the serve by running the command below. Don't close the serve as this will be required to be used by the frontend server.

```
php artisan serve
```
![Cloning the Project](/installation_files/coding_test_7.PNG "Cloning the Project").


## 5. Install Dependencies for frontend
- From another terminal window into travel-agency-front-end inside your project and run npm install to intall frontend dependencies.

```
npm install
```
![Cloning the Project](/installation_files/coding_test_8.PNG "Cloning the Project").


## 6. Start Frontend Server
- Start your Frontend server by running npm run dev.

```
npm run dev
```
![Cloning the Project](/installation_files/coding_test_9.PNG "Cloning the Project").


## 6. Accessing the Website
- ### The frontend runs on port 3000, you can now access it on the browser at localhost:3000

![Cloning the Project](/installation_files/coding_test_10.PNG "Cloning the Project").

## LOGIN DATA.

| User             | Username               | Password     |
| -----------------|:----------------------:| ------------:|
| Admin            | admin@admin.com        | password     | 
| Staff            | staff@admin.com        | password     |   
| Travel Agent     | travelagent@admin.com  | password     |  


