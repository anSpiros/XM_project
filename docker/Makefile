SHELL='/bin/bash'

create-project:
	@docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /src \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../front":/src \
		react npx create-react-app ${NAME}

npm-install-package:
	docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /src \
		--expose 3000 \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../front":/src \
		react npm install ${PACKAGE}

npm-install-package-dev:
	docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /src \
		--expose 3000 \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../front":/src \
		react npm install --save-dev ${PACKAGE}

npm-install:
	docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /src \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../front":/src \
		react npm install

run-front-tests:
	docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /src \
		--expose 3000 \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../front":/src \
		react npm test

run-back-tests:
	docker run \
		--rm \
		--tty \
		--interactive \
		--workdir /var/www \
		--expose 3000 \
		--user $(shell id -u):$(shell id -g) \
		--volume "$(PWD)/../back":/var/www \
		symfony php bin/phpunit