# HNG12 Stage 1 

## Description
The Number Classification API takes a number as input and returns:
-Whether it is prime
-Whether it is perfect
-Whether it is an Armstrong number (only for positive numbers)
-Whether it is odd or even
-The sum of its digits
-A fun fact about the number from the Numbers API

This API is built using Laravel and follows RESTful principles, returning responses in JSON format.

## API Endpoint
- `GET /api/classify-number?number={number}`

## api documentation

### request sample
    ```sh
    GET /api/classify-number?number=371
    ```

### Success response Format (200 OK)
```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

### Error response (400 Bad Request)
```json
{
    "number": "alphabet",
    "error": true

}
```


**How to Run Locally**
1. Clone the repository:
   ```sh
   git clone https://github.com/Josh6335/HngStage1.git.git
   cd hngstage1
   ```
2. run the composer
   ```sh
   composer install
    ```
4. Generate application key
    ```sh
    php artisan key:generate
    ```
5. Run the application
   ```sh
   php artisan serve
   ```
7. Visit "https://your-api.com/api/classify-number?number={number}" in your browser or use Postman.

##Contributors
-Musediku joshua
**For more information, you can visit https://hng.tech/hire/php-developers**
