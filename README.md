# Prérequis avant de lancer le projet

- npm 
- php 8.2
- mysql/maria db
- git

## Première étape

clone le repository 
```
git clone https://github.com/demacedius/vparrot_php.git
```

## Deuxième étape
*Entrez dans le dossier précédemment cloné*
```bash
cd vparrot_php/
```

## Troisième étape
*Installer tailwindcss*

```bash
npm install -D tailwindcss
```

## Quatrième étape
*Créer la base de donnée et la remplir de l'administrateur*

***Modifiez les variable suivante par les votres***
```php
$servername = "127.0.0.1";
$username = "root"; // a modifier
$password = "Amandine2412."; //A modifier
```
```bash
php admin/creerBdd.php
```


```bash
php admin/create_admin.php
```
> A noter que le mot de passe de l'administrateur et azerty

## Cinquième étape
*Ajouter une première voiture*
```sql
INSERT INTO voiture (prix, kilometrage, annee, image, nom, description) VALUES
        (15000.00, 50000, 2020, 'ferrari.jpg', 'Car Model A', 'Description for Car Model A');
```

## Dernière étape
*lancer le projet en local à partir du dossier*
```bash
php -S localhost:8080
```
