This web app is using Vue js in the frontend and Laravel in the backend.


Laravel is responsible for the creation of the rest apis and the server logic,for the authentication of the apis Laravel  build in api token authentication is used.


The above web app is used as a blog app.The admin has full control of the app through the admin panel and can create,edit and delete posts,categories and tags.The admin can also see user comments associated with each post and delete the ones he dont like of find out that maybe are spam.Furthermore the admin can create other admins through the backend and attach them a role(author or admin role can be attached to the user).Each role has associated permissions and actions that the user may execute or not. 
For the creation of the admin model we created a new guard in Laravel.

For the frontend mainly Vue js has been used each page consists of one or more Vue js components that use axios to consume the rest apis created in the backend with Laravel..



----------------------------------------------------------------
For the creation of the post content Froala editor has been integrated to our project you.. can find out more about this editor here ->> https://froala.com/wysiwyg-editor/

