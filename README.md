
In order app to work must follow the below steps

 Clone repository or download as a zip.
 
 You can find it [here](https://github.com/anSpiros/XM_project)
 
 When clone completes or download, navigate to `docker` folder and run `docker-compose up --build` .
  
When build completes , open [http://localhost:3000](http://localhost:3000) to view the front app in the browser.

At `docker` folder a `Makefile` exists.

The available commands for `Makefile` are the following:
 - `make run-npm-install`
     - Install all packages from package.json file
 - `make npm-install-package`
     - Install package
 - `make npm-install-package-dev`
    - Install package as devDependency
 - `make run-front-tests`,
    - Run all tests for front-end application
 - `make run-back-tests`
    - Run all tests for back-end application
