## Authentication APP Example

### Installation setup

Requirements:
    - "php": "^7.3"

Installation:
    - php phars/composer.phar install (To install composer dependencies)

Test execution:
    - ./vendor/bin/phpunit tests

### Description

We need to create a new service to Authenticate users.

This service will have only one public method and this will receive an email and a password as arguments.

As we want to make this service very flexible, we have to think on the possibility to change the origin of the users.

Password must meet the following requirements:
- Length between 6 and 10 characters.
- At least 1 number.
- At least one special character
When the service login succeed it should not return any response.

The service can fail login in these cases:
1. Password does not meet requirements. (Service should specify the reason)
2. User not found.
3. Login failed.
4. User blocked. This happens when user fail login three consecutive times.

In that cases, the service should return an exception.
