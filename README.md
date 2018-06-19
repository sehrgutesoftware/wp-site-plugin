# WordPress Site Plugin

> Boilerplate for site-specific business logic and customization

## Setup

### 1. Clone project

```bash
git clone git@github.com:sehrgutesoftware/wp-site-plugin.git <my-plugin-name>
cd <my-plugin-name>
```

### 2. Add custom git remote

```bash
git remote rename origin upstream
git remote add origin <my-custom-remote>
git push -u origin master
```

### 3. Rename main plugin file

```bash
mv wp-site-plugin.php <my-plugin-name>
```

### 4. Set custom composer package name

```bash
sed -i -- 's/sehrgut\/wp-site-plugin/<my-package-name>/g' composer.json
```

### 5. (optional) Replace text domain and php namespace

If you want to replace the defaults with your custom localization text domain and php namespace, globally find & replace the following strings:

- `wp-site-plugin` (text domain)
- `Sehrgut\WpSitePlugin` (php namespace)

## Usage

Individual customisations are defined in tasks, to keep everything more understandable and maintainable. Write a separate task for each business requirement.

### Adding a Task

1. Create a copy of `tasks/ExampleTask.php` and give it a proper name
2. Set the same name as class name for the Task
3. Register your hooks and filters using `protected $hooks`, along the lines of the examples
4. Register the task in your main plugin file by `require`ing it, and listing it in `protected $tasks`

### Models

TBD
