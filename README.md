<p align="center"><img src="http://www.codefii.com/public/images/codefii.png" width="60" height=""60"/></p>

<p align="center">
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/stable" alt="Stable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/downloads" alt="Download"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/unstable" alt="Umstable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/license" alt="License"></a>
</p>

## About Codefii


Codefii is a stunningly fast high-level  web framework that encourages rapid development and includes everything needed to create database-backed web applications.

Under the hood, codefii has a generic admin called **FiiA** that helps in managing database records. it's somewhat known as active admin.
___



### Getting started

Before anything else, you need a copy of composer installed on local machine through [composer](http://getcomposer.org).For existing applications you can run the following:

```
composer create-project --prefer-dist codefii/codefii myApp
```

### Running your project

After a successful installation of the codefii components, the next thing is to navigate to your app directory and serve / run your app by using:

```
cd myApp
php fii --serve
```
then visit your browser and type:
```
localhost:8080
```
### Running App with a Dynamic Port
```
cd myApp
php fii --serve --port=your_port_number
```
### Documentation
The complete documentation is found on [Codefii Official Website](https://codefii.com/documentaion)
