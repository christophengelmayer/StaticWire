# StaticWire

Module for [ProcessWire](https://processwire.com/) that coverts pages to static HTML files via CLI or the admin interface.
Useful in CI/CD scripts or to use ProcessWire as a simple static site generator.

## Installation

Install via the ProcessWire modules directory. See [Instructions](https://modules.processwire.com/install-uninstall/)

## Configuration

The module has a configuration option ("**Static file path**\") for the directory in which the static HTML files and folders are generated. The path is relative to the root directory of your installation. *(default: `/static`)*

## Usage

### via CLI (Command Line Interface)

Navigate to the root folder of your website:

    cd /your/website

Run the script

    php site/modules/StaticWire/cli.php

### via admin interface

After installing, go to Setup > Static Site Generator and click the "Generate" button.

Users need the `staticwire-generate` permission in order to run StaticWire.

## Alternatives

If you need a much more advanced solution please have a look at [Ryan Cramer](http://directory.processwire.com/developers/ryan-cramer/)'s wonderful [ProCache](https://modules.processwire.com/modules/pro-cache/) module.

Copyright 2020 by Christoph Engelmayer
