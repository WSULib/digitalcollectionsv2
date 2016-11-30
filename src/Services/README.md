# Services

This directory holds custom application dependencies; they are managed by the (dependency container)[../dependencies.php]. These custom bits of code that are necessary for the application to work. For example, this application needs a specific way to communicate with the WSUDOR API endpoint. APIRequest controls all of the application's communication with the WSUDOR API, since this framework is simply a way for patron's communicate with the WSU Digital Repository via a search and display interface.

Normally, application dependencies (such as Guzzle or Twig) are installed by Composer and placed in the (vendor)[../vendor] directory; however, since we have code that is specific to this application, they reside in the Services directory. It is named services because when application dependencies are loaded by the dependency container, they are made available to the application and are now referred to as services.

One final note, the dependency container has a few built-in services including a settings associative array (found (here)[../settings.php]); request and response interfaces; and error handling, among others.


#### Reference
https://www.slimframework.com/docs/concepts/di.html