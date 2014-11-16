#Welcome!#
**This project is just my personal work of creating some simple MVC structure**  

#FAQ#

##Where to place new modules?##
`app/module/`  
Then you create your MVC model as usual, and to run that you need to use the Controller/Model/View in your project, or just map the url to the controller in your `[YOUR_MODEL_NAME].json` file. Loader will automatically load all necessary files if you work with valid namespaces folder structure.

##How to call/run your modules?##
You just need to call the Controller/Model/View method that loades a Module to RAM, then you instantiniate it, and **that's it!** 

##Where to place routes?##
**Answer is simple -\>**
`app/routes/*.json`  

###How to generate URLs?##
Just call
`$router->generate('users_show', array('id' => 5));`  

###USED SOFTWARE:###
**\*NOTE\*** - *i have only used the best and the simpliest software on the earth, so i'm recommending them*  
    
[**AltoRouter**](https://github.com/dannyvankooten/AltoRouter) - MVC routing library by Danny Van Kooten  
[**log4php**](http://logging.apache.org/log4php/) - professional logging system  
[**phpmailer**](https://github.com/PHPMailer/PHPMailer)  
[**Rain Templating Engine**](http://www.raintpl.com/) - easy to use templates with **caching**  