deploy: public/build/manifest.json
	rsync -avz public/build infotuto:~/sites/mon-blog.adrien-aubourg.fr/public
	ssh infotuto 'cd ~/sites/mon-blog.adrien-aubourg.fr && git pull origin main && make install'

install: vendor/autoload.php
	php console/bin cache:clear


vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php

public/build/manifest.json: package.json
	npm i
	npm run build