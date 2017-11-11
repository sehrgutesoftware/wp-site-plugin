# WordPress Site Plugin

> Boilerplate for site-specific business logic and customization

# Setup

## 1. Clone project

```bash
git clone git@github.com:sehrgutesoftware/wp-site-plugin.git <my-plugin-name>
cd <my-plugin-name>
```

## 2. Add custom git remote

```bash
git remote rename origin upstream
git remote add origin <my-custom-remote>
git push -u origin master
```

## 3. Rename main plugin file

```bash
mv wp-site-plugin.php <my-plugin-name>
```

## 4. Set custom composer package name

```bash
sed -i -- 's/sehrgut\/wp-site-plugin/<my-package-name>/g' composer.json
```

## 5. (optional) Replace text domain and php namespace

If you want to replace the defaults with your custom localization text domain and php namespace, globally find & replace the following strings:

- `wp-site-plugin` (text domain)
- `Sehrgut\WpSitePlugin` (php namespace)

