# Pasos para Ejecucion testOptime

1. Realizar el Clon del Repositorio:
    git clone https://github.com/hom669/testOptime.git
    
    ![image](https://user-images.githubusercontent.com/78924776/168609171-1d1aa5d8-1bc9-4bfd-a80f-aec84959e4d5.png)
    
2. Acceder a carpeta testOptime
    cd testOptime
    
    ![image](https://user-images.githubusercontent.com/78924776/168609386-a702883b-7cac-48cd-a13f-c31edb6a10ae.png)
    
3. Ejecutar comando de Instalación de Dependencias:
    * composer install
    * yarn install
    * npm install
    
    ![image](https://user-images.githubusercontent.com/78924776/168609798-9ae72edb-8266-4ec6-bff1-3f290ff919e1.png)
    
    ![image](https://user-images.githubusercontent.com/78924776/168610148-c849dda2-ee58-4f3c-ad83-af07f7a58356.png)

    ![image](https://user-images.githubusercontent.com/78924776/168610501-f7a964ce-b681-4d6c-8cd1-36132f331aaa.png)
    
    ![image](https://user-images.githubusercontent.com/78924776/168612210-6e1fdd5d-b9cc-4f40-a45b-4053c5bd2d7a.png)

4.  Inicializar Motor de Base de Datos en Mi Caso Maria-Db en Xampp
    
    ![image](https://user-images.githubusercontent.com/78924776/168610771-fdb7d978-91d0-448d-bc60-f9241ef3ce09.png)

5. Si Es necesario Modificar Cadena de conexión en el archivo .env Linea 31

  ![image](https://user-images.githubusercontent.com/78924776/168611292-14e7a742-4736-4862-89b3-1477678d7375.png)

6. Ejecutar Comando para Iniciar Creación Base de Datos
   
   * php bin/console doctrine:migrations:diff
   
   ![image](https://user-images.githubusercontent.com/78924776/168612314-016bff4d-93e2-4e2a-82a4-819268339115.png)
   
   ![image](https://user-images.githubusercontent.com/78924776/168612766-8b98592d-534f-498c-aeb9-46e36a9803b5.png)

7. Ejecutar Comandos Para Migraciones
  * php bin/console doctrine:migrations:diff
  * php bin/console doctrine:migrations:migrate
  
8. Ejecutar Comando para Fixtures Date:
  * bin/console doctrine:fixtures:load
  * Responder con Yes
  
  ![image](https://user-images.githubusercontent.com/78924776/168613064-ad13f79c-56fd-48d2-a48e-a496e482d996.png)

9. Ejecutar comando para iniciar Proyecto
  * php bin/console server:run

  ![image](https://user-images.githubusercontent.com/78924776/168613523-305a7daf-aea7-4990-a9d2-1979592e1eaf.png)
 
 10. Ejecutar Proyecto en el navedador con url dada:
    http://127.0.0.1:8000
    
 11. Realizar Pruebas Necesarias:
 
![image](https://user-images.githubusercontent.com/78924776/168613845-18f51fa5-4730-4194-a40c-5a2d7fe56817.png)

![image](https://user-images.githubusercontent.com/78924776/168613954-a0514767-ad0c-4698-a13b-30652455dfa8.png)

![image](https://user-images.githubusercontent.com/78924776/168614104-a03eeb36-0c28-4f9d-bfed-55d8bacfee56.png)

![image](https://user-images.githubusercontent.com/78924776/168614158-8cd7e09a-a5b5-49eb-8373-6e12a169ea56.png)

# Especificaciones Tecnicas

Aplicativo Desarrollado en 

Symfony 5.4
MariaDB 10.4
Base de Datos: test_optime

Diagrama Entidad Relacion 

![image](https://user-images.githubusercontent.com/78924776/168614686-878056fe-25be-4a99-922b-491e28e28edf.png)

Bundles Usados:

phpspreadsheet 
orm doctrine

Css:

Bootstrap 5
SweetAlert 2



 

  


