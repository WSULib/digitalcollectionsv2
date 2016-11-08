# WSU Digital Collections, v2

Based on the [Slim PHP framework](http://www.slimframework.com/), specifically the [Slim-Skeleton template](https://github.com/slimphp/Slim-Skeleton)

## Installation

Run custom script to install composer and dependencies:

    ./provision.sh

## Running / Testing

To run the application in development, you can also run this command:

    composer start

Run this command to run the test suite:

    composer test

## Troubleshooting

Full composer reset:

    composer self-update
    composer diagnose
    composer update -v
    rm -rf vendor/
    composer update -v

