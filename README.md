Ecommerce
=========

## Pré-requis

Composer ==> https://getcomposer.org/doc/00-intro.md

##  Procédure d'installation

1. En https: git clone https://github.com/Deimokle/Ecommerce.git
2. composer install
3. A la fin du composer install, configurer la base de donnée et le serveur mail
4. php app/console doctrine:database:create
5. php app/console doctrine:schema:update --force
6. Installer la version correspondant au système de 'wkhtmltopdf' ==> http://wkhtmltopdf.org/
7. Créer un enregistrement "Paramètres généraux" ==> à detailler
8. mkdir -p web/uploads/aleatoire web/uploads/categ web/uploads/drapeaux web/uploads/param web/uploads/pdf web/uploads/produits web/uploads/newsletters
9. chmod -R 777 web/uploads/ app/cache/ app/logs/


## Une fois projet installé, étapes de mise en place
1. Créer repertoires uploads/aleatoire + uploads/categ + uploads/drapeaux + uploads/param + uploads/pdf + uploads/produits
2. 
1. Créer une langue
2. Créer des taux de TVA
3. Créer des catégories de produit 
4. Paramètres généraux
5. Créer les catégories // Niveau 1 ==> Sois Tableaux / Bijoux

A Symfony project created on May 24, 2016, 11:25 am.
