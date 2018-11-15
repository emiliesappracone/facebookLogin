## Facebook login : <a href="https://benmarshall.me/facebook-php-sdk/2/#step-1">DOC</a>

### Needed : 

* psr-4 autoload
* SDK/Graph
* Create an app facebook : <a href="https://developers.facebook.com/apps/">here</a>
* Get creds, go to Settings (Paramètres > Général)

```
composer require aura/autoload
```

```
composer require facebook/graph-sdk
```

### Create files :

```
    mkdir index.php
    mkdir fb-callback.php
    mkdir login.php
    mkdir logout.php
```