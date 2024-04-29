<?php

/**
 * Gloubi Boulga WP CakePHP(tm) 5 adapter
 * Copyright (c) Gloubi Boulga Team (https://github.com/gloubi-boulga-team)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2024 - now | Gloubi Boulga Team (https://github.com/gloubi-boulga-team)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://github.com/gloubi-boulga-team
 * @since     5.0
 */

declare(strict_types=1);

return [

    'zip-plugin' => [

        'gbg-cake5' => [
            'name'  => 'gbg-cake5',                             // plugin name
            'dir'   => dirname(__DIR__) . '/gbg-cake5',    // plugin dir
            'ignore' => [
                '/\.git(.*)/i',                         // ignore recursively .git* folders / files
                '/composer\.(json|lock)$/i',            // ignore recursively composer.json and composer.locks
                '/^[dir]\/repo-cli\.md/i',              // ignore repo-cli.md
                '/changelog(.*)/i',                     // ignore recursively changelog* files (avoid exposing versions)
                '/VERSION(\.txt)?/i',                   // ignore recursively VERSION file
                '/phpstan.neon(.*)/i',                  // ignore recursively phpstan.neon* files
                '/(!readme).*\.txt$/i',                 // ignore recursively *.txt files except readme
                '/(.*)\.log$/i',                        // ignore *.log files
                '/^[dir]\/readme.md/i',                  // ignore git-reserved readme.md
                '/^[dir]\/tests/i',                     // ignore root folder /tests
                '/^[dir]\/env/i',                       // ignore root folder /env
                '/^[dir]\/examples/i',                  // ignore root folder /env
                '/^[dir]\/bin/i',                       // ignore root folder /bin
                '/^[dir]\/dist/i',                      // ignore root folder /dist
                '/^[dir]\/tools/i',                     // ignore root folder /tools
                '/^[dir]\/(.*)\.inc$/i',                 // ignore *.inc files
                '/^[dir]\/gbg-dev-tools\.inc\.php$/i',   // ignore gbg-dev-tools.inc.php file
            ]
        ],

        'gbg-cake5-demo' => [
            'name'  => 'gbg-cake5-demo',                // plugin name
            'dir'   => __DIR__,                         // plugin dir
            'ignore' => [
                '/\.git(.*)/i',                         // ignore recursively .git* folders / files
                '/composer\.(json|lock)$/i',            // ignore recursively composer.json and composer.locks
                '/^[dir]\/repo-cli\.md/i',              // ignore repo-cli.md
                '/changelog(.*)/i',                     // ignore recursively changelog* files (avoid exposing versions)
                '/phpstan.neon(.*)/i',                  // ignore recursively phpstan.neon* files
                '/(.*)\.txt$/i',                        // ignore recursively *.txt files
                '/(.*)\.log$/i',                        // ignore *.log files
                '/^[dir]\/tests/i',                     // ignore root folder /tests
                '/^[dir]\/env/i',                       // ignore root folder /env
                '/^[dir]\/bin/i',                       // ignore root folder /bin
                '/^[dir]\/dist/i',                      // ignore root folder /dist
                '/^[dir]\/tools/i',                     // ignore root folder /tools
                '/^[dir]\/gbg-dev-tools\.inc\.php$/i',   // ignore gbg-dev-tools.inc.php file
            ]
        ]
    ],
];
