# DTRT WordPress Parent Theme

[![GitHub release](https://img.shields.io/github/release/dotherightthing/wpdtrt.svg?branch=master)](https://github.com/dotherightthing/wpdtrt/releases) [![Build Status](https://travis-ci.org/dotherightthing/wpdtrt.svg?branch=master)](https://travis-ci.org/dotherightthing/wpdtrt) [![GitHub issues](https://img.shields.io/github/issues/dotherightthing/wpdtrt.svg)](https://github.com/dotherightthing/wpdtrt/issues) [![GitHub wiki](https://img.shields.io/badge/documentation-wiki-lightgrey.svg)](https://github.com/dotherightthing/wpdtrt/wiki)

Parent theme for WordPress theme development.

Originally generated by the [DTRT WordPress Theme Boilerplate Generator](https://github.com/dotherightthing/generator-wp-theme-boilerplate), this theme has since been modified to loosely mirror the approach of the [DTRT WordPress Plugin Boilerplate](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate).

## Setup

```
composer install
yarn install
yarn run build
```

## Releases

Update the `n.n.n` version in these files:

1. ./README.txt
2. ./composer.json
3. ./gulpfile.js
4. ./package.json
5. ./style.css

Update the Changelog with the relevant commit messages:

1. ./README.txt

Commit changes:

1. Commit these changes with the message 'Bump version'
2. Tag this commit with `n.n.n`
3. Push the commit to GitHub
4. Wait for the release zip to be generated at [https://github.com/dotherightthing/wpdtrt/releases](https://github.com/dotherightthing/wpdtrt/releases)
5. Edit the release, adding the Changelog messages to the release description

## Deployment

The DTRT WordPress Parent Theme uses Gulp and Travis build systems. There is configuration for WordPress unit tests, but these are currently not run.

When tagged commits are pushed to GitHub, a release is automatically generated by Travis.

However, because this parent theme is used on multiple sites, there is no automated deployment.
