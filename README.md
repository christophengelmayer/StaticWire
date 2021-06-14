# StaticWire

[ProcessWire](https://processwire.com/) Module that converts pages to static HTML files via CLI or the admin interface.
Useful in CI/CD scripts or to use ProcessWire as a static site generator.

## Installation

Install via the ProcessWire modules directory. See [Instructions](https://modules.processwire.com/install-uninstall/).

## Configuration

The configuration option ("**Static file path**\") defines the directory in which the static HTML files and folders are generated. The path is relative to the root directory of your ProcessWire installation. *(default: `/static`)*

## Usage

### via CLI (Command Line Interface)

Navigate to the root folder of your website:

    cd /var/www/mysite

Run the script

    php site/modules/StaticWire/cli.php

### via admin interface

Go to Setup > Static Site Generator and click the "Generate" button.

Users need the `staticwire-generate` permission in order to run StaticWire.

## How does it work?

The module creates a folder structure mirroring the page tree of your website.
In each folder a `index.html` file with the corresponding page content is generated.

To generate the static HTML structure the `$page->render()` function is called on each page.

### Asset handling

**Assets (like CSS or JavaScript) and uploaded files are not copied!**

To handle assets and uploads you have multiple options:

* copy the folders (`site/assets/files`, `site/templates/style`, `site/templates/scripts`, etc.) to the output directory (`static/`)
* copy them in your CI/CD script
* create symlinks if the static site and your ProcessWire installation are running on the same server

## Roadmap 

* [ ] Supprt paginated templates
* [ ] Download static site as *.zip archive

## Alternatives

If you need a more advanced solution please have a look at [Ryan Cramers](http://directory.processwire.com/developers/ryan-cramer/) wonderful [ProCache](https://modules.processwire.com/modules/pro-cache/) module.
