BtnEventBundle
==================================================================
Simple bundle for generate form for event (symfony 2.3) and save to dabase

1. add the following to your `composer.json`:

        "bitnoise/event-bundle": "dev-master"

    and

        "repositories": [
            {
                "type": "vcs",
                "url":  "https://github.com/Bitnoise/BtnEventBundle.git"
            }
        ],

    and run:

        php composer.phar install
2. Add this bundle to your application's kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Btn\EventBundle\BtnEventBundle(),
                // ...
            );
        }

3. add to routing.yml:

        btn_event:
            resource: "@BtnEventBundle/Controller/"
            type:     annotation
            prefix:   /
