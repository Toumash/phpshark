#Welcome!#
**This project is just my own work of creating simple, lightweight HMVC structure**  

#FAQ#

##Where to place new modules?##
**There:** `app/module/`  
Then you create your MVC model as usual  
`app/module/x/model`  
`app/module/x/view`  
`app/module/x/controller`  
and place there your files `*.class.php`

##How to call/run your modules?##
Just use `Controller->loadModule('MODULE');` and fire an action by `Controller->mod['MODULE']['CONTROLLER']->action();`  
**That's it!** Controller loades and creates all your necessary classes for you : )  

##Where to place routes?##
**Answer is simple -\>**
`app/routes/*.json`  
or for the module routing  
`app/routes/[MODULE_NAME]*.json`  

###How to generate URLs?##
Just call
`$router->generate('users_show', array('id' => 5));`  

###USED SOFTWARE:###
**\*NOTE\*** - *i have only used the best and the simpliest software on the earth, so i'm recommending them*  
    
[**AltoRouter**](https://github.com/dannyvankooten/AltoRouter) - MVC routing library by Danny Van Kooten  
[**log4php**](http://logging.apache.org/log4php/) - professional logging system  
[**phpmailer**](https://github.com/PHPMailer/PHPMailer) - "upgraded" php build-in mailer   
[**Rain Templating Engine**](http://www.raintpl.com/) - fast and easy template creating