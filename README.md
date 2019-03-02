<p align="center"><img src="https://www.codefii.com/images/codefii.png" width="60" height=""60"/></p>
<p align="center">
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/stable" alt="Stable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/downloads" alt="Download"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/unstable" alt="Ustable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/license" alt="License"></a>
</p>

## About Codefii

Codefii is a web application framework for PHP. It provides a beautifully expressive and easy to use tools for backend development and Apis.

---

## Introduction

Codefii having two phrases **code** and **fii** (pronounced : fire 🔥 ) is a PHP framework for building website backend. It consists of approachable and easy to use libraries that helps you tackle complex problems with just few lines of codes.

## Documentation

After pulling the Codefii skeletal project, am pretty sure you would be curious to make something cool with it, now let's get to it quickly.

- Before getting started, it's essential you understand how the folder is arranged and what they represent. There are three basic folders namely :

- **app**
- **web**
- **vendor**

#### The App Directory

The app directory contains **Controllers**, **Views** and **Models** where you'll focus more on when building any project with Codefii

#### The Web Directory

The web directory contains static files such as images, javascript and css files.

### The Vendor Directory

I think it's better to ignore the vendor directory as it contains the primary engine of Codefii.

## Creating a controller

Create a file named **WelcomeController.php** in _App\Controllers_ directory and add the following code:

```php
namespace App\Controllers;
use App\Controllers\Controller;
class WelcomeController extends Controller{
    public function home(){
        echo "Hello World!";
    }
}
```

## Creating route

Moving to the next step, route. To initiate a route that matches your controller, open _App/routes/routes.php_ and make changes where possible.

```php

$router = new Codefii\Http\Router();
$router->setNamespace('App\Controllers');
$router->get('/','Welcome.home');
```

## Using fii cli command

At this point, you're almost close to done, open up a terminal in your current working directory and type

```php
php fii --serve
```

Then navigate to your browser and access the page on **localhost:8000**

### 🔥 Community

Join the welcoming community of fellow Codefii developers on [Slack](http://codefii.slack.com).

### 🚀 Contributing

To contribute a **feature or idea** to Codefii, [create an issue](https://github.com/codefii/codefii/issues/new) explaining your idea.

### 🏫 Tutorials

The awesome Codefii community is always adding new tutorials and articles out there, [Learn Codefii](http://learn.codefii.com) is a great place to get started as a beginner.

### 👥 Backers

Support us with a monthly donation and help us continue our activities. [[Become a backer](https://opencollective.com/codefii#backer)]
