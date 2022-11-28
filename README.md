# company-history

# Installation
First clone the repository : 

$ git clone git@github.com:haymen/company-history.git

Next, entrer dans le dossier cloné : 
`$ cd company-history`

Next, lancer l'image docker :
`docker-compose -f $PWD/.docker/docker-compose.yml --env-file=$PWD/.docker/.env  up -d`

# Navigation & URLs

## Liste des sociétés : 
http://localhost/company

## Ajouter une société avec ses adresses  : 
http://localhost/company/create
  
