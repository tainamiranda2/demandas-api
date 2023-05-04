## api rest com php - sistema de demandas

## metodos

## get - ver todos os papeis
## get/id - ver apenas um papeis
## edit/id - editar um papel
## post - criar  um papel
## delete - deletar  um papel

## get - ver todos os demandas
## get/id - ver apenas uma demanda
## edit/id - editar uma demanda
## post - criar uma demanda
## delete - deletar  uma demanda

## get - ver todos os status
## get/id - ver apenas um status
## edit/id - editar um status
## post - criar  um status
## delete - deletar  um status

## get - ver todos os usuario
## get/id - ver apenas um usuario
## edit/id - editar um usuario
## post - criar  um usuario
## delete - deletar  um usuario

## get - ver apenas um  setor
## get/id - ver apenas um setor
## edit/id - editar um setor
## post - criar  um setor
## delete - deletar  um setor
## tenha o php na versão 7.2 e composer instado, de o composer install para baixar as atualizações e poder rodar o  projeto

# essas configuações devem esta no seu config.php
# 'AllowOrigin' => '*',
#   'AllowCredentials' => true,
#  'AllowMethods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE','OPTIONS'],
# 'AllowHeaders' => true,
#  'ExposeHeaders' => false,
# 'MaxAge' => 86400, // 1 day
# 'exceptionRenderer' => 'Cors\Error\AppExceptionRenderer',
        
## usando a arquitetura mvc (Model, views, controller)

### comando para criar controller - php bin/cake.php bake controller Papel 
### comando para criar model - php bin/cake.php bake model Papel 
### comando para criar view - php bin/cake.php bake template Papel index,edit ou add 
