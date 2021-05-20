
# SymfonyMaintenanceListener 

<p align="center">
 <img width="460" height="300" src="https://symfony.com/images/logos/header-logo.svg">
 <br>

  <img width="460" height="300" src="maintenance.png">
</p>

This short snippet aim to easily handle setting a Symfony 5.*+ website to maintenance mode.

Certain users with defined roles can continue surfing on the site, usefull to allow team to test the app even in maintenance (See comments in MaintenanceListener.php file).

Please follow simply these steps to set up maintenance feature on your symfony powered website:


## Set params

Copy the content of [services.yaml](/services.yaml) (in this repo) to your config/services.yaml

## MaintenanceListener

Create src/Services/Listener/MaintenanceListener.php and copy the content of [MaintenanceListener.php](/MaintenanceListener.php) in it.

- Don't forget to customize your $allowRoutesInMaintenance to serve certains routes to public even in maintenance (login, etc)
- This is important for you (admin or team), to authenticate yourself before having full access to the site in maintenance
- Don't forget to set your twig templates path correctly.

## Register the Listener

 Register your Listener in your config/services.yaml file or copy the content of [services.yaml](/services.yaml) to your config/services.yaml

## Twig

Create a twig template to server publicly in maintenance mode or see the [maintenance.html.twig](/maintenance.html.twig ) file in this repo



[![GitHub Repo stars](https://img.shields.io/github/stars/ePatrioteCreative/epatriote_smart_benin?label=github%20stars)](https://github.com/ePatrioteCreative/epatriote_smart_benin)
[![GitHub last commit](https://img.shields.io/github/last-commit/ePatrioteCreative/epatriote_smart_benin)](https://github.com/ePatrioteCreative/epatriote_smart_benin)



Happy hacking

*Thank to be __eP__*