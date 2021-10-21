# Reproduction repo

## Error/bug

Number attributes are encoded as strings when the API is queried in tests. This happens when the database is SQLite.
It does not happen with MySQL.

## Steps

### install the project

```bash
composer install
php artisan migrate
```

### query the api

seed the database and run the server

```
php artisan tinker --execute="Foo::factory()->count(10)->create()"
php artisan serve
```

### query the foos endpoint

```
curl http://localhost:8000/api/v1/foos | json_pp -json_opt pretty,canonical
```

Here is an example of a returned resource:

```json
{
         "attributes" : {
            "createdAt" : "2021-10-21T13:05:43.000000Z",
            "number" : 2443553183,
            "updatedAt" : "2021-10-21T13:05:43.000000Z"
         },
         "id" : "1",
         "links" : {
            "self" : "http://localhost:8000/api/v1/foos/1"
         },
         "type" : "foos"
      }
```

The "number" attribute is a number (no quotes).

### run the tests

```bash
php artisan test
```

Here is an output of the tests:

```bash
   FAIL  Tests\Feature\FooTest
  ⨯ the foos resource structure

  ---

  • Tests\Feature\FooTest > the foos resource structure
  Failed asserting that the member at [/data] exactly matches:
  {
      "attributes": {
          "createdAt": "2021-10-21T13:21:33.000000Z",
          "number": 130060754,
          "updatedAt": "2021-10-21T13:21:33.000000Z"
      },
      "id": "1",
      "links": {
          "self": "http://localhost/api/v1/foos/1"
      },
      "type": "foos"
  }
  
  within JSON API document:
  {
      "data": {
          "attributes": {
              "createdAt": "2021-10-21T13:21:33.000000Z",
              "number": "130060754",
              "updatedAt": "2021-10-21T13:21:33.000000Z"
          },
          "id": "1",
          "links": {
              "self": "http://localhost/api/v1/foos/1"
          },
          "type": "foos"
      },
      "jsonapi": {
          "version": "1.0"
      },
      "links": {
          "self": "http://localhost/api/v1/foos/1"
      }
  }.

  at vendor/cloudcreativity/json-api-testing/src/Constraints/ExactInDocument.php:76
     72▕             return $result;
     73▕         }
     74▕ 
     75▕         if (!$result) {
  ➜  76▕             $this->fail($other, $description, Compare::failure($this->expected, $actual));
     77▕         }
     78▕ 
     79▕         return null;
     80▕     }

      +4 vendor frames 
  5   tests/Feature/FooTest.php:35
      LaravelJsonApi\Testing\TestResponse::assertFetchedOneExact(["foos", "1"])
  --- Expected
  +++ Actual
  @@ @@
   {
       "attributes": {
           "createdAt": "2021-10-21T13:21:33.000000Z",
  -        "number": 130060754,
  +        "number": "130060754",
           "updatedAt": "2021-10-21T13:21:33.000000Z"
       },
       "id": "1",

  Tests:  1 failed
  Time:   0.37s
```

The "number" attribute is a string (quotes).
