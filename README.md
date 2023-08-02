# GeoLocation API

This is a Laravel-based project that allows users to generate API keys and get geolocation details of IP addresses. 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You need to have the following installed on your local machine:

- PHP >= 7.4
- Composer
- SQLLite (or any database that you prefer)

### Installation

1. Clone the repository to your local machine:

    ```
    git clone https://github.com/yourusername/your-repository.git
    ```

2. Go to the project directory:

    ```
    cd your-repository
    ```

3. Install the PHP dependencies of the project:

    ```
    composer install
    ```

4. Copy the example env file:

    ```
    cp .env.example .env
    ```

5. Generate an application key:

    ```
    php artisan key:generate
    ```

6. Create an empty database and add your database credentials into your .env file:
    ```
    touch database/database.sqlite
    ```

    ```
    DB_CONNECTION=sqlite
    #DB_HOST=127.0.0.1
    #DB_PORT=3306
    #DB_DATABASE=laravel
    #DB_USERNAME=root
    #DB_PASSWORD=
    ```

7. Migrate the database:

    ```
    php artisan migrate
    ```

8. Finally, start the application:

    ```
    php artisan serve
    ```

The application will be running at [http://localhost:8000](http://localhost:8000).

## Usage

### Generate an API Key

Make a POST request to the `/api/generate-api-key` endpoint with the following JSON body:

```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "yoursecurepassword"
}
```

To generate your api key you can use a javascript or a php cpde

##JQuery TEST
```
var form = new FormData();
form.append("name", "John Test");
form.append("email", "test@test.com");
form.append("password", "safkhaskfhas");

var settings = {
  "url": "http://127.0.0.1:8000/api/generate-api-key",
  "method": "POST",
  "timeout": 0,
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "data": form
};

$.ajax(settings).done(function (response) {
  console.log(response);
});
```

##PHP TEST
```
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/api/generate-api-key',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('name' => 'Jonh Test','email' => 'jonh@gmail.com','password' => 'SDKHGDSKHGS')
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
```

##After Genarate the Key you can call the IP Location 

#Jquery
```
var settings = {
  "url": "http://127.0.0.1:8000/api/ip-details",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "api_token": "your-key-generated",
    "Content-Type": "text/plain"
  },
  "data": "{\r\n    \"ips\": [\"111.111.1.1\", \"192.168.1.2\"]\r\n}",
};

$.ajax(settings).done(function (response) {
  console.log(response);
});
```

#PHP
```
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/api/ip-details',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>'{
    "ips": ["174.95.254.184", "192.168.1.2"]
}',
  CURLOPT_HTTPHEADER => array(
    'api_token: your-key-generated',
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
```
