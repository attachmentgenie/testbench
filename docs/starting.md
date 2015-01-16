# Getting started with testbench

## Initialize testbench environment

``` php
./vendor/bin/testbench testbench:init
```

This creates a placeholder test and some basic config files within the current directory. This will enable 


## Make sure PHP can use MongoDB

``` php
./vendor/bin/testbench php:mongo
```

## Running Test Suite

``` php
./vendor/bin/testbench db:test
