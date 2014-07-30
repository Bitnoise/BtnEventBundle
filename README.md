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

4. Add BtnEventBundle to the assetic.bundle config

        // app/config/config.yml
        assetic:
            #...
            bundles:
                #...
                - BtnEventBundle

5. Add parameters for Calendar module

        // config_dev.yml
        btn_event:
            calendar:
                parameters:
                    resources:            BtnEventBundle:Calendar
                    twig:
                        month:                month
                        week:                 week
                        day:                  day
                        mini:                 mini
                    extension:            html.twig
                    dictionary:
                        months:
                            short:
                                1:                   Sty.
                                2:                   Lu.
                                3:                   Mar.
                                4:                   Kw.
                                5:                   Maj.
                                6:                   Czerw.
                                7:                   Lip.
                                8:                   Sier.
                                9:                   Wrz.
                                10:                  Paź.
                                11:                  Lis.
                                12:                  Gru.
                            short_sms:
                                1:                   sty
                                2:                   lut
                                3:                   mar
                                4:                   kwie
                                5:                   maj
                                6:                   czer
                                7:                   lip
                                8:                   sier
                                9:                   wrze
                                10:                  paz
                                11:                  list
                                12:                  gru
                            extended:
                                1:                   Styczeń
                                2:                   Luty
                                3:                   Marzec
                                4:                   Kwiecień
                                5:                   Maj
                                6:                   Czerwiec
                                7:                   Lipiec
                                8:                   Sierpień
                                9:                   Wrzesień
                                10:                  Październik
                                11:                  Listopad
                                12:                  Grudzień
                            spell:
                                1:                   stycznia
                                2:                   lutego
                                3:                   marca
                                4:                   kwietnia
                                5:                   maja
                                6:                   czerwca
                                7:                   lipca
                                8:                   sierpnia
                                9:                   września
                                10:                  października
                                11:                  listopada
                                12:                  grudnia
                        days:
                            short:
                                1:                   Pn
                                2:                   Wt
                                3:                   Śr
                                4:                   Czw
                                5:                   Pt
                                6:                   Sb
                                7:                   Nd
                            extended:
                                1:                   Poniedziałek
                                2:                   Wtorek
                                3:                   Środa
                                4:                   Czwartek
                                5:                   Piątek
                                6:                   Sobota
                                7:                   Niedziela
                    minute_height:        0.7
                    height:               600
                    hour_start:           0
                    hour_end:             22
                    show_week_nb:         true
                    show_days:            days
