# ApiServer Sourceeasy #

# Move this to https://bitbucket.org/sourceasy/wiki/wiki/Home


ApiServer + Oauth2 Server

## Objects ###
* Users
* Roles
* Scopes

User has Roles

Roles has scopes

Scopes define a permission

### List of Scopes ###
GET|HEAD /                                       

GET|HEAD oauth2/authorize                        
GET|HEAD oauth2/clients                          

POST oauth2/clients                              
GET|HEAD oauth2/clients/{clients}                               
DELETE oauth2/clients/{clients}                  

GET|HEAD v1/users                                
POST v1/users                                    
GET|HEAD v1/users/{users}                        
PUT v1/users/{users}                             
PATCH v1/users/{users}                           
DELETE v1/users/{users}                          

GET|HEAD v1/roles                                
POST v1/roles                                    
GET|HEAD v1/roles/{roles}                        
PUT v1/roles/{roles}                             
PATCH v1/roles/{roles}                           
DELETE v1/roles/{roles}                          


GET|HEAD v1/scopes                               
POST v1/scopes                                   
GET|HEAD v1/scopes/{scopes}                      
PUT v1/scopes/{scopes}                           
PATCH v1/scopes/{scopes}                         
DELETE v1/scopes/{scopes}                        

GET|HEAD v1/users/{users}/roles                  
GET|HEAD v1/roles/{role}/users                   
GET|HEAD v1/users/{users}/roles/{roles}/authorize
GET|HEAD v1/users/{users}/roles/{roles}/revoke   
GET|HEAD resource                                
