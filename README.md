<p align="center"><img src="https://codefii.com/public/images/codefii.png" width="60" height=""60"/></p>

<p align="center">
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/stable" alt="Stable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/downloads" alt="Download"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/v/unstable" alt="Umstable"></a>
<a href="https://packagist.org/packages/codefii/codefii"><img src="https://poser.pugx.org/codefii/codefii/license" alt="License"></a>
</p>

## About Codefii
Codefii is a superfast micro-framework, the first of its kind delivered as a general purpose framework to give acces and control and security to web Ninjas. Just as the name implies, codefii is a general purpose framework, it's doesn't force you to write in a particular pattern, once you have a prior knowledge of php you are good to go.

## Documentation
# using session
```
<?php
$session = new Session();
$session->set('user','prince darlington');
$session->register();
if($session->isRegistered()){
  echo $session->get('user');
}
```
***
## using redirect for routing
<br>
<p> in a case where you want to redirect to a certain page with some parameter e.g https://codefii.com/home/123, with ***home***  being the
sub route and ***123*** being the route parameter this is how to achieve it.</p>

```
<?php
Redirect::to('home',['paramater'=>123]);
or
Redirect::to('home');
```

***
## Directory Structure
<p>
 <br/>
 <b style="color:red;">Codefii/ </b>              internally used build tools(development files)
 <br/>
 <b style="color:red;">public/     </b>           static files
 <br/>
 <b style="color:red;">vendor/   </b>            core framework code

  </p>

## Community
<br/>
Participate in discussions at <a href="https://forum.codefii.com">forum</a>.<br/>
Community chat on <a href="https://codefii.slack.com">slack</a>.<br/>
Follow us on twitter <a href="https://twitter.com/codefii1">@codefii1</a>.<br/>

## Reporting Security issues
If you discover any vulnerability or have any issues you would like to report kindly message the project manager at <a href="mailto:ekeminyd@gmail.com">Prince Darlington</a>

## License
The Codefii  framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
## Acknowledgement
The Codefii team would like to thank <a href="http://soodarsoft.com">Soodaroft</a>,
all the contributors to the Codefii project and you, the Codefii user.
