# php-proxy-sap-machinelearning-api
A PHP proxy for the SAP machine learning API which needs an APIKey header, secured via BasicAuth.

The **php** is the destination file for the SAP Cloud Platform Connectivity.

The **index.html** and **neo-app.json** need to be inside your SAP Web IDE and and can be deployed to the SAP Cloud Platform. 

The **.htaccess** and **apitranslate.php** need to be deployed to your own webspace. Provide your own API key inside this file.

The **apitranslate.php** file is secured via basic auth, you maintain user and password inside the destination in the SAP Cloud Platform. This file finally sends the request to the SAP Leonardo Machine Learning API including the API Key inside the header.
