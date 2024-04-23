# Gravity Forms x Polylang

This Wordpress plugin adds form titles, descriptions, field labels, etc, to Polylang string translations

This repository is a fork of [pdme/gravity-forms-polylang](https://github.com/pdme/gravity-forms-polylang) to update the plugin to work with the latest version of wordpress and implement open pull requests of the original repository.

## Installation
### Traditional Wordpress installation
Download the latest version of the plugin from the [Releases](https://github.com/siebsie23/gravity-forms-polylang/releases) section manually upload a new plugin in the "plugins" section of your wordpress installation.

### Wordpress via composer
Add the release as a repository to your composer.json file. Example:
```json
"repositories": [
    {
        "type": "package",
        "package": {
            "name": "siebsie23/gravity-forms-polylang",
            "version": "1.0.0",
            "type": "wordpress-plugin",
            "dist": {
                "type": "zip",
                "url": "https://github.com/siebsie23/gravity-forms-polylang/archive/refs/tags/1.0.0.zip"
            },
            "require": {
                "ffraenz/private-composer-installer": "^5.0"
            }
        }
    }
]
```
And add the plugin to the requirements. Example:
```json
"require": {
    "siebsie23/gravity-forms-polylang": "1.0.0"
}
```
After this, run `composer update` and activate the plugin in the "plugins" section of your wordpress installation